<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Chart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $cart = Cart::select(Cart::raw('date(created_at) as Date'), Cart::raw('sum(subtotal) as Total'))->groupBy('created_at')->pluck('Total', 'Date')->all();
        // for ($i=0; $i<count($cart); $i++) {
        //     $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        // }
        // $chart = new Chart;
        // $chart->labels = (array_keys($cart));
        // $chart->dataset = (array_values($cart));
        // $chart->colours = $colours;
        //dd($chart);
        return view('home');
    }

    public function edit($id)
    {
        $products = Product::find($id);
        return view('product.productupdate')->with('products', $products);
    }
}
