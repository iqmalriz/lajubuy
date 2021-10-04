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
        $currentAddress = Address::where('userid', Auth::id())->get()->first();
        $address = new Address();
        $address->aname = $request->input('aname');
        $address->aphone = $request->input('aphone');
        $address->zip = $request->input('zip');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->street = $request->input('street');
        if ($currentAddress === null) { // kalau address xde
            $address->default = '1';
            $address->shopadd = '1';
        } else { // kalau address dah ada
            $address->default = '0';
            $address->shopadd = '0';
        }
        $address->street = $request->input('street');
        $address->userid = Auth::id();
        $address->save();
        return redirect('/address');
    }

    public function deleteaddress($id)
    {
        $address = Address::find($id);
        $address->delete();
        return redirect('/address');
    }    

    public function setasdefault($id)
    {
        $currentAddress = Address::where('default', '1')->where('userid', Auth::id())->first();
        $currentAddress->default = '0';
        $currentAddress->save();

        $address = Address::find($id);
        $address->default = '1';
        $address->save();
        return redirect('/address');
    }

    public function setaspickup($id)
    {
        $currentAddress = Address::where('shopadd', '1')->where('userid', Auth::id())->first();
        $currentAddress->shopadd = '0';
        $currentAddress->save();

        $address = Address::find($id);
        $address->shopadd = '1';
        $address->save();
        return redirect('/address');
    }





    public function addressseller()
    {
        $address = Address::where('userid', Auth::id())->get();
        return view('user.addressseller')->with('addresses', $address);
    }

    public function addaddressseller(Request $request)
    {
        $currentAddress = Address::where('userid', Auth::id())->get()->first();
        $address = new Address();
        $address->aname = $request->input('aname');
        $address->aphone = $request->input('aphone');
        $address->zip = $request->input('zip');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->street = $request->input('street');
        if ($currentAddress === null) { // kalau address xde
            $address->default = '1';
            $address->shopadd = '1';
        } else { // kalau address dah ada
            $address->default = '0';
            $address->shopadd = '0';
        }
        $address->street = $request->input('street');
        $address->userid = Auth::id();
        $address->save();
        return redirect('/addressseller');
    }

    public function deleteaddressseller($id)
    {
        $address = Address::find($id);
        $address->delete();
        return redirect('/addressseller');
    }    

    public function setasdefaultseller($id)
    {
        $currentAddress = Address::where('default', '1')->where('userid', Auth::id())->first();
        $currentAddress->default = '0';
        $currentAddress->save();

        $address = Address::find($id);
        $address->default = '1';
        $address->save();
        return redirect('/addressseller');
    }

    public function setaspickupseller($id)
    {
        $currentAddress = Address::where('shopadd', '1')->where('userid', Auth::id())->first();
        $currentAddress->shopadd = '0';
        $currentAddress->save();

        $address = Address::find($id);
        $address->shopadd = '1';
        $address->save();
        return redirect('/addressseller');
    }
}

