<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\Shop;
use Illuminate\Support\Facades\Auth;

class ProductChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $cart = Product::select(Product::raw('products.name as Name'), Product::raw('count(carts.id) as Total'))
            ->join('carts', 'carts.productid', '=', 'products.id')
            ->groupBy('Name')->where('status', 'completed')
            ->whereIn('productid', Product::select('id')->whereIn('shopid', Shop::select('id')->where('userid', Auth::id())))
            ->pluck('Total', 'Name')->all();
        return Chartisan::build()
            ->labels(array_keys($cart))
            ->dataset('Sold Product', array_values($cart));
    }
}