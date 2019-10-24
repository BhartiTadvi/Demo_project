<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Coupon;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        auth()->user()->givePermissionTo('role-create');
         $ordersCount = Order::get();
         $userCount = User::get();
         $couponCount = Coupon::get();
         $productCount = Product::get();
        return view('home',compact('ordersCount','userCount','couponCount','productCount'));
    }
}
