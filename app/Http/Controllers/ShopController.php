<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products= Product::all();
        return view('shop.home',compact('products'));
    }
}
