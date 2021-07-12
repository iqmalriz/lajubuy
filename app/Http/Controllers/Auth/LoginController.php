<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        login as performLogin;
    }

    public function login(Request $request) {
        $this->performLogin($request);
        $currentOrder = Order::where('userid', Auth::id())->where('completed', 0)->get()->first();
        if ($currentOrder === null) { //if takda order
            $order = new Order();
            $order->date = now();
            $order->completed = 0;
            $order->userid = Auth::id();
            $order->save();
        } else {
            $order = Order::find($currentOrder->id);
            $order->date = now();
            $order->save();
        }
        return redirect('/');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
