<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Cart;
use App\Address;
use App\Product;
use App\Review;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addtocart(Request $request)
    {   //check kalau ada order tak complete
        $currentOrder = Order::where('userid', Auth::id())->where('completed', 0)->get()->first();
        if ($currentOrder === null) { //if takda order
            $order = new Order();
            $order->date = now();
            $order->completed = 0;
            $order->userid = Auth::id();
            $order->save();

            $cart = new Cart();
            $cart->orderid = $order->id;
            $cart->productid = $request->input('productid');
            $cart->quantity = $request->input('quantity');
            $cart->save();
        } else { //if ada order
            $currentProduct = Cart::where('orderid', $currentOrder->id)->where('productid', $request->input('productid'))->get()->first();
            if ($currentProduct === null) {
                $cart = new Cart();
                $cart->orderid = $currentOrder->id;
                $cart->productid = $request->input('productid');
                $cart->quantity = $request->input('quantity');
                $cart->save();
            } else {
                $cart = Cart::find($currentProduct->id);
                $cart->quantity = $cart->quantity + $request->input('quantity');
                $cart->save();
            }
        }
        $request->session()->flash('status', 'Item has been added to your shopping cart');
        $request->session()->flash('icon', 'success');
        //$product = Product::find($cart->productid);
        return redirect('/detailproduct/'.$cart->productid);
    }

    public function showcart()
    {
        $currentOrder = Order::where('userid', Auth::id())->where('completed', 0)->get()->first();
        if ($currentOrder === null) { //if takda order
            $order = new Order();
            $order->date = now();
            $order->completed = 0;
            $order->userid = Auth::id();
            $order->save();
        }
        $currentOrder = Order::where('userid', Auth::id())->where('completed', 0)->get()->first();
        $currentCart = Cart::join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('carts.orderid', $currentOrder->id)
                        ->select('*', 'carts.id as cartid')
                        ->get();
                        //dd($currentCart);
        $sum = $currentCart->sum('quantity');
        return view('cart.cartshow')->with('order', $currentOrder)->with('carts', $currentCart)->with('sum', $sum);
    }

    public function addone($id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $cart->quantity + 1;
        $cart->save();
        return redirect("/showcart");
    }

    public function minusone($id)
    {
        $cart = Cart::find($id);
        $cart->quantity = $cart->quantity - 1;
        $cart->save();
        if ($cart->quantity == 0)
            $cart->delete();
        return redirect("/showcart");
    }


    public function deletecart($id)
    {
        $cart = Cart::find($id);
        //dd($cart);
        $cart->delete();
        return redirect("/showcart");
    }

    public function order()
    {
        $allCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('orders.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $toshipCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('orders.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->where('carts.status', 'toship')
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $toreceiveCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('orders.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->where('carts.status', 'toreceive')
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $completedCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('orders.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->where('carts.status', 'completed')
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $cancelledCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('orders.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->where('carts.status', 'cancel')
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $sum = $allCart->sum('quantity');
        $sum2 = $toshipCart->sum('quantity');
        $sum3 = $toreceiveCart->sum('quantity');
        $sum4 = $completedCart->sum('quantity');
        $sum5 = $cancelledCart->sum('quantity');

        return view('cart.order')->with('carts', $allCart)->with('toshipCart', $toshipCart)->with('toreceiveCart', $toreceiveCart)->with('completedCart', $completedCart)->with('cancelledCart', $cancelledCart)
        ->with('sum', $sum)->with('sum2', $sum2)->with('sum3', $sum3)->with('sum4', $sum4)->with('sum5', $sum5);
    }

    public function orderseller()
    {
        $allCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('shops.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $toshipCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('shops.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->where('carts.status', 'toship')
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $shippingCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('shops.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->where('carts.status', 'toreceive')
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $completedCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('shops.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->where('carts.status', 'completed')
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();

        $cancelCart = Order::join('carts', 'orders.id', '=', 'carts.orderid')
                        ->join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('shops.userid', Auth::id())
                        ->where('orders.completed', 1)
                        ->where('carts.status', 'cancel')
                        ->select('*', 'carts.id as cartid')
                        ->orderBy('orders.updated_at', 'DESC')
                        ->get();


        $sum = $allCart->sum('quantity');

        return view('cart.orderseller')->with('carts', $allCart)->with('toshipCart', $toshipCart)->with('shippingCart', $shippingCart)->with('completedCart', $completedCart)->with('cancelCart', $cancelCart);
    }

    public function checkout($id)
    {
        $currentOrder = Order::find($id);
        $currentCart = Cart::join('products', 'carts.productid', '=', 'products.id')
                        ->join('shops', 'products.shopid', '=', 'shops.id')
                        ->where('carts.orderid', $currentOrder->id)
                        ->select('*', 'carts.id as cartid')
                        ->get();
                        //dd($currentCart);
        $sum = $currentCart->sum('quantity');
        $addresses = Address::where('userid', Auth::id())->get();
        $defaultaddress = Address::where('userid', Auth::id())->where('default', '1')->get()->first();
        return view('cart.checkout')->with('order', $currentOrder)->with('carts', $currentCart)->with('sum', $sum)->with('default', $defaultaddress)->with('addresses', $addresses);
    }

    public function orderdetail($id)
    {
        $cart = Cart::
        join('orders', 'carts.orderid', '=', 'orders.id')
        ->join('addresss', 'orders.addressid', '=', 'addresss.id')
        ->join('products', 'carts.productid', '=', 'products.id')
        ->join('shops', 'products.shopid', '=', 'shops.id')
        ->where('carts.id', $id)
        ->select('*', 'carts.id as cartid')
        ->get()->first();
        return view('cart.orderdetail')->with('cart', $cart);
    }

    // public function cancelorder($id)
    // {
    //     $cart = Cart::find($id);
    //     $cart->status = 'pcancel';
    //     $cart->save();
    //     // $product = Product::find($cart->productid);
    //     // $product->quantity = $product->quantity + $cart->quantity;
    //     // $product->save();
    //     return redirect('/order');
    // }

    // public function approvecancel($id)
    // {
    //     $cart = Cart::find($id);
    //     $cart->status = 'cancel';
    //     $cart->save();

    //     $product = Product::find($cart->productid);
    //     $product->stock = $product->stock + $cart->quantity;
    //     $product->save();
    //     return redirect('/orderseller');
    // }

    public function placeorder(Request $request, $id)
    {
        $order = Order::find($id);
        $order->completed = '1';
        $order->addressid = $request->input('address');
        $order->save();

        Cart::where('orderid', $id)->update(['status' => 'toship']);

        $request->session()->flash('title', 'The order has been paid!');
        $request->session()->flash('status', 'We have noticed the seller for further update');
        $request->session()->flash('icon', 'success');
        return redirect('/order');
    }

    public function orderdetailseller($id)
    {
        $cart = Cart::
        join('orders', 'carts.orderid', '=', 'orders.id')
        ->join('addresss', 'orders.addressid', '=', 'addresss.id')
        ->join('products', 'carts.productid', '=', 'products.id')
        ->join('shops', 'products.shopid', '=', 'shops.id')
        ->where('carts.id', $id)
        ->select('*', 'carts.id as cartid')
        ->get()->first();
        return view('cart.orderdetailseller')->with('cart', $cart);
    }

    public function updatetracknum(Request $request, $id)
    {
        $cart = Cart::find($id);
        $cart->tracknum = $request->input('tracknum');
        $cart->status = 'toreceive';
        $cart->save();
        return redirect('/orderdetailseller/'.$id);
    }

    public function receiveorder($id)
    {
        $cart = Cart::find($id);
        $cart->status = 'torate';
        $cart->save();
        return redirect('/orderdetail/'.$id);
    }

}
