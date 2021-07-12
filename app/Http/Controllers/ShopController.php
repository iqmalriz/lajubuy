<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Product;
use App\User;




class ShopController extends Controller
{
    public function shop($id)
    {
        $shop = Shop::find($id);
        $product = Product::where('shopid', $id)->get();
        $user = User::find($shop->userid);
        $count = $product->count();
        return view('shop.viewshop')->with('shop', $shop)->with('products', $product)->with('user', $user)->with('count', $count);
    }
}
