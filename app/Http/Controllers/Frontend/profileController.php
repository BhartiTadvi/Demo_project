<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Address;
use App\Order;
use Auth;

class profileController extends Controller
{
    //
       public function index()
    {
        //
        return view('frontend.profile');
    }
    
    //
       public function userAccount()
    {
    	 $profile = User::get();
    	 
        //
        return view('frontend.account',compact('profile'));
    }
    
    //     public function userOrder()
    // {
    //     //
    //     return view('frontend.order');
    // }
        public function trackOrder()
    {
        //
        return view('frontend.trackorder');
    }
    
      public function showChangePasswordForm()
    {
        //
        return view('frontend.password');
    }

    public function updatePassword(Request $request)
    {
       // dd($request->all());
       $this->validate($request, [
        'current_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required',
    ]);
    }
     public function userAddress()
    {
        //
        $address=Address::get();
        return view('frontend.address',compact('address'));
    }

     public function getOrder()
    {
        $user_id= Auth::id();

        
        $orders=Order::with('products','products.product')->where('user_orders.user_id',$user_id)->get();



           
       // $orders = User::with(['order' => function($q) {
       //                  $q->with('order.productOrder','productOrder.product');}])->where('id',Auth::id())->get();
        // $products =User::with('productOrder,productOrder.product')->where('id',Auth::id())->get();

        // dd($orders[0]->products[0]->product->productImage[0]->image);

        return view('frontend.order',compact('orders'));
    }


}
