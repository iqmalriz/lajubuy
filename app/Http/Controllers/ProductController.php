<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Shop;
use App\User;
use App\Image;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index()
    {
        $shop = Shop::where('userid', Auth::id())->get()->first();
        //dd($shop);
        $products = Product::where([['isdeleted', 0], ['shopid', $shop->id]])->where('stock', '>', '0')->get();
        $products2 = Product::where([['isdeleted', 0], ['shopid', $shop->id]])->where('stock', '0')->get();

        return view('product.product')->with('products', $products)->with('products2', $products2); 
    }

    public function productadd()
    {
        $categories = Category::all();
        return view('product.productadd')->with('categories', $categories);;
    }

    public function create(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/product/', $filename);
            $product->image = $filename;
        } else {
            $product->image = '';
        }

        $product->isdeleted = '0';
        $product->categoryid = $request->input('category');
        $shop = Shop::where('userid', Auth::id())->get()->first();
        $product->shopid = $shop->id;
        $product->save();

        // $image = new Image();
        // if ($request->hasfile('image')) {
        //     $file = $request->file('image');
        //     $extension = $file->getClientOriginalExtension(); //getting image extension
        //     $filename = time() . '.' . $extension;
        //     $file->move('uploads/product/', $filename);
        //     $image->path = $filename;
        //     $image->productid = $product->id;
        // }
        // $image->save();

        return redirect('listproduct');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/product/', $filename);
            $product->image = $filename;
        } else {
            $product->image = $product->image;
        }

        $product->save();

        return redirect('listproduct');
    }

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $product->isdeleted = '1';
        $product->save();
        
        $request->session()->flash('status', 'Product have been removed');
        $request->session()->flash('icon', 'info');
        return redirect('listproduct');
    }

    public function detail($id)
    {
        $product = Product::find($id);
        //dd($product);
        $shop = Shop::find($product->shopid);
        $product2 = Product::where('shopid', $shop->id)->get();
        $user = User::find($shop->userid);
        $count = $product2->count();
        return view('product.productdetail')->with('product', $product)->with('shop', $shop)
        ->with('user', $user)->with('count', $count);
    }

}
