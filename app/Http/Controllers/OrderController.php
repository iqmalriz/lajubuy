<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;

class OrderController extends Controller
{
    public function index() {
        return view ('order.order');
    }

    public function createOrder() {
        
    }
}
