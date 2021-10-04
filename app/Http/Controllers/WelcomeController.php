<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Review;


class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::
            join('shops', 'products.shopid', '=', 'shops.id')
            ->join('users', 'shops.userid', '=', 'users.id')
            ->join('addresss', 'addresss.userid', '=', 'users.id')
            ->select('*', 'products.name as pname', 'products.id as pid', 'products.image as pimage')
            ->orderBy('sold', 'desc')
            ->orderBy('productrate', 'desc')
            ->where('stock', '>', '0')
            ->where('shopadd', '1')
            ->get();
            //dd($products);
        return view('welcome')->with('products', $products);
    }
}
