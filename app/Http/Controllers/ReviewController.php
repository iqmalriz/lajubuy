<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Review;
use App\Product;

use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addreview(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->status = 'completed';
        $cart->save();

        $review = new Review();
        $review->comment = $request->input('comment');
        $review->rating = $request->input('star');
        $review->userid = Auth::id();
        $review->productid = $cart->productid;
        $review->save();

        $review = Review::where('productid', $cart->productid)->get();
        $star1 = $review->where('rating', '1')->count();
        $star2 = $review->where('rating', '2')->count();
        $star3 = $review->where('rating', '3')->count();
        $star4 = $review->where('rating', '4')->count();
        $star5 = $review->where('rating', '5')->count();
        $totalstar = $star5 + $star4 + $star3 + $star2 + $star1;
        if ($totalstar == 0) {
            $calculateReview = 0.0;
        } else {
            $calculateReview = (5*$star5 + 4*$star4 + 3*$star3 + 2*$star2 + 1*$star1) / ($totalstar);
        }

        $product = Product::find($cart->productid);
        $product->productrate = $calculateReview;
        $product->totalrate = $totalstar;
        $product->save();

        $request->session()->flash('status', 'Thanks for your review!');
        $request->session()->flash('icon', 'success');

        return redirect('/orderdetail/'.$id);
    }
}
