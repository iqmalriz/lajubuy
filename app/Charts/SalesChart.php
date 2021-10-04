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



class SalesChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     * 
     */
    public function handler(Request $request): Chartisan
    {
        $cart = Cart::select(Cart::raw('date_format(created_at, "%b %Y") as Date'), Cart::raw('sum(subtotal) as Total'))
            ->groupBy('Date')->where('status', 'completed')
            ->whereIn('productid', Product::select('id')->whereIn('shopid', Shop::select('id')->where('userid', Auth::id())))
            ->orderByRaw("FIELD(Date, 'Jan 2021', 'Feb 2021', 'Mar 2021', 'Apr 2021', 'Mei 2021', 'Jun 2021', 'Jul 2021', 'Aug 2021', 'Sep 2021', 'Oct 2021', 'Nov 2021', 'Dec 2021')")
            ->pluck('Total', 'Date')->all();
        $order = Cart::select(Cart::raw('date_format(created_at, "%b %Y") as Date'), Cart::raw('count(id) as Count'))
            ->groupBy('Date')->where('status', 'completed')
            ->whereIn('productid', Product::select('id')->whereIn('shopid', Shop::select('id')->where('userid', Auth::id())))
            ->orderByRaw("FIELD(Date, 'Jan 2021', 'Feb 2021', 'Mar 2021', 'Apr 2021', 'Mei 2021', 'Jun 2021', 'Jul 2021', 'Aug 2021', 'Sep 2021', 'Oct 2021', 'Nov 2021', 'Dec 2021')")
            ->pluck('Count', 'Date')->all();
        return Chartisan::build()
            ->labels(array_keys($cart))
            ->dataset('Total Sales (RM)', array_values($cart))
            ->dataset('Total Order', array_values($order));
    }
}