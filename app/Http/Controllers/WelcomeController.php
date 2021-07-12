<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', '0')->get();
        return view('welcome')->with('products', $products);
    }
}
