<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.product');
    }

    public function create(Request $request)
    {
        $product = new Product();

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/product/', $filename);
            $product->image = $filename;
            
            // $path = $request->file('image')->getRealPath();
            // $imgblob = file_get_contents($path);
            // $base64 = base64_encode($imgblob);
            // $path = $request->file('image');
            // $contents = $path->openFile()->fread($path->getSize());
            // $product->imagebinary = $contents;

            $newfile = file_get_contents('uploads/product/'. $filename);
            // dd($newfile);
            $base64 = 'data:image/' . $extension . ';base64,' . base64_encode($newfile);
            $product->imagebinary = $base64;


        } else {
            return $request;
            $product->image = '';
        }

        $product->save();

        return redirect('home');
    }

    // public function listproduct()
    // {
    //     $product = Product::all();
    //     return view('home')->with('', $product);
    // }

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

            // $path = $request->path('image');
            // $type = pathinfo($path, PATHINFO_EXTENSION);
            // $data = file_get_contents($file);
            // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // $product->imagebinary = $base64;

        } else {
            return $request;
            $product->image = '';
            $product->imagebinary = '';
        }

        $product->save();

        return redirect('home');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('home')->with('product', $product);
    }

    public function detail($id)
    {
        $product = Product::find($id);
        return view('product.productdetail')->with('product', $product);
    }

    public function comment($id)
    {
        $products = Product::find($id);
        return view('product.productcomment')->with('products', $products);

    }

    public function postcomment(Request $request, $id)
    {
        $product = Product::find($id);

        $product->comment = $request->input('comment');

        if ($request->hasfile('video')) {
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension(); //getting video extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/product/', $filename);
            $product->video = $filename;
        } else {
            return $request;
            $product->video = '';
        }

        if ($request->hasfile('audio')) {
            $file = $request->file('audio');
            $extension = $file->getClientOriginalExtension(); //getting audio extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/product/', $filename);
            $product->audio = $filename;
        } else {
            return $request;
            $product->audio = '';
        }

        $product->save();

        return view('product.productdetail')->with('product', $product);
    }

    public function deletecomment($id)
    {
        $products = Product::find($id);
        $products->comment = '';
        $products->video = '';
        $products->audio = '';

        $products->save();
        return view('product.productdetail')->with('product', $products);

    }
}
