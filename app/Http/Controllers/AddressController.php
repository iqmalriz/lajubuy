<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Shop;
use App\Address;

class AddressController extends Controller
{
    public function address()
    {
        $address = Address::where('userid', Auth::id())->get();
        return view('user.address')->with('addresses', $address);
    }

    public function addaddress(Request $request)
    {
        $address = new Address();
        $address->aname = $request->input('aname');
        $address->aphone = $request->input('aphone');
        $address->zip = $request->input('zip');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->street = $request->input('street');
        $address->userid = Auth::id();
        $address->save();
        return redirect('/address');
    }

    
}

