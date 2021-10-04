<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Shop;
use App\Address;





class UserController extends Controller
{
    public function account() 
    {
        $user = User::find(Auth::id());
        $shop = Shop::where('userid', Auth::id())->get()->first();
        return view('user.account')->with('user', $user)->with('shop', $shop);
    }

    public function updateaccount(Request $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/user/', $filename);
            $user->image = $filename;
        } else {
            $user->image = $user->image;
        }
        $user->save();
        
        $shop = Shop::where('userid', Auth::id())->get()->first();
        $shop->sname = $request->input('sname');
        $shop->save();
        $request->session()->flash('status', 'Profile Updated');
        $request->session()->flash('icon', 'success');
        return redirect('/account');
    }

    public function password()
    {
        return view('user.changepassword');
    }

    public function accountseller() 
    {
        $user = User::find(Auth::id());
        $shop = Shop::where('userid', Auth::id())->get()->first();
        return view('user.accountseller')->with('user', $user)->with('shop', $shop);
    }

    public function updateaccountseller(Request $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->dob = $request->input('dob');
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/user/', $filename);
            $user->image = $filename;
        } else {
            $user->image = $user->image;
        }
        $user->save();
        
        $shop = Shop::where('userid', Auth::id())->get()->first();
        $shop->sname = $request->input('sname');
        $shop->save();
        $request->session()->flash('status', 'Profile Updated');
        $request->session()->flash('icon', 'success');
        return redirect('/accountseller');
    }

    public function passwordseller()
    {
        return view('user.changepasswordseller');
    }
}

