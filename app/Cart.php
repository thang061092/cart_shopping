<?php

namespace App;


class Cart
{
    public $items;
    public $totalPrice;
    public $totalQuantity;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalPrice = $oldCart->totalPrice;
            $this->totalQuantity = $oldCart->totalQuantity;
        }
    }

    public function add($product)
    {
        $productStore = [
            "item" => $product,
            "totalQuantity" => 0,
            "totalPrice" => 0
        ];
        if ($this->items) {
            if (array_key_exists($product->id, $this->items)) {
                $productStore = $this->items[$product->id];
            }
        }
        $productStore['totalQuantity']++;
        $productStore['totalPrice'] += $product->price;
        $this->items[$product->id] = $productStore;
        $this->totalQuantity++;
        $this->totalPrice += $product->price;

    }

    public function remove($id)
    {
        if ($this->items) {
            $productsInCart = $this->items;
            if (array_key_exists($id, $productsInCart)) {
                $this->totalPrice -= $productsInCart[$id]['totalPrice'];
                $this->totalQuantity -= $productsInCart[$id]['totalQuantity'];
                unset($productsInCart[$id]);
                $this->items = $productsInCart;
            }
        }
    }

    public function update($request, $id)
    {
        if ($this->items) {
            $productsInCart = $this->items;
            if (array_key_exists($id, $productsInCart)) {
                $productUpdate = $productsInCart[$id];
                $qtyUpdate = $request->qty - $productUpdate['totalQuantity'];
                $this->totalQuantity += $qtyUpdate;
                $priceUpdate = $productUpdate['item']->price * $request->qty - $productUpdate['totalPrice'];
                $this->totalPrice += $priceUpdate;
                $productUpdate['totalQuantity'] = $request->qty;
                $productUpdate['totalPrice'] = $productUpdate['item']->price * $request->qty;
                $this->items[$id] = $productUpdate;
            }
        }
    }

}
