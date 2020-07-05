<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Cart;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart($id)
    {
        $product = $this->product->findOrFail($id);
        $oldCart = Session::get('cart');
        $newCart = new Cart($oldCart);
        $newCart->add($product);
        Session::put('cart', $newCart);
        Session::flash('add-to-cart-success', 'Them sp vao gio hang thanh cong');
        return back();
    }

    public function showCart()
    {
        $cart = Session::get('cart');
        return view('cart.showCart', compact('cart'));
    }

    public function remove($idProduct)
    {
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            if (count($oldCart->items) > 0) {
                $cart = new Cart($oldCart);
                $cart->remove($idProduct);
                Session::put('cart', $cart);
                toastr()->success('Đã xóa sản phẩm trong giỏ hàng', 'Success');
            } else {
                toastr()->error('Bạn chưa mua sp nào', 'Inconceivable!');
            }
        } else {
            toastr()->error('Bạn chưa mua sp nào', 'Inconceivable!');
        }
        return back();
    }

    public function update(Request $request, $idProduct)
    {
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            if (count($oldCart->items) > 0) {
                $cart = new Cart($oldCart);
                $cart->update($request, $idProduct);
                Session::put('cart', $cart);
                toastr()->success('Giỏ hàng vừa được cập nhật');
            } else {
                toastr()->error('fail', 'Inconceivable!');
            }
        } else {
            toastr()->error('fail', 'Inconceivable!');
        }
        return back();
    }

    public function checkOut()
    {
        return view('cart.checkout');
    }

    public function payment(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();
        $cart = Session::get('cart');
        $customer1 = Customer::all();
        $bill = new Bill();
        $bill->dateBuy = getdate()['year'] . "-" . getdate()['mon'] . "-" . getdate()['mday'];
        $bill->total = $cart->totalPrice;
        $bill->note = $request->note;
        $bill->customer_id = $customer1[count($customer1) - 1]['id'];
        $bill->save();
        toastr()->success('Đơn hàng của bạn đang được xử lý ');
        foreach ($cart->items as $key => $product){
            $bill->products()->attach($key);
        }

        return redirect()->route('shop.home');

    }

}
