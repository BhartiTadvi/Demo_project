<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Address;
use App\Order;
use Auth;
use App\OrderDetail;
use DB;
use Hash;
use Session;
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
         $orders = Session::get('orders');

        return view('frontend.trackorder',compact('orders'));
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
            'confirm_password'=>'required|same:new_password',
    ]);

       $current_password =$request->current_password;
       $new_password =$request->new_password;
       $confirm_password =$request->confirm_password;

     if (!(Hash::check($current_password, Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($current_password, $new_password) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
       
        $user = Auth::user();
        $user->password = bcrypt($new_password);
        $user->save();

    return redirect()->back()->with("success","Password changed successfully !");
   
    }
     public function userAddress()
    {
        //
        $user_id= Auth::id();
        $address=Address::where('user_id',$user_id)->get();
        return view('frontend.address',compact('address'));
    }

     public function getOrder()
    {
        $user_id= Auth::id();

        $orders=Order::with('products','products.product')->where('user_orders.user_id',$user_id)->get();
         //dd($orders);
        return view('frontend.order',compact('orders'));
    }


    public function showOrder($id)
    {
       
        $user_id= Auth::id();

        
        $orders=Order::with('products','products.product')->where('user_orders.user_id',$user_id)->find($id);
           // dd($id);
        // dd($orders);

       
     return view('frontend.show-product',compact('orders'));

    }

    public function orderStatus(Request $request)
    {
       //dd($request->all());
         $this->validate($request, [
        'emailid'=>'required',
        'orderid'=>'required'
            
    ]);
         $email=$request->emailid;
         $orderid=$request->orderid;

         $users=User::where('email',$email)->get();

         foreach($users as $user)
         {
            $user_id =$user->id;
         }

        $orders =Order::with('orderDetail')->where('user_id',$user_id)->where('id',$orderid)->get();

         // dd($orders);
      
         Session::put('orders',$orders);

       //dd($orders[0]->orderDetail->transaction_status);
        // $orders=Order::where('user_id',$user_id)->get();
         //$orders=OrderDetail::get();

         // $orders = DB::table('user_orders')
         //    ->join('order_details', 'user_orders.id', '=', 'order_details.order_id')
         //    ->join('users', 'users.id', '=', 'user_orders.user_id')
         //    ->select('order_details.*', 'order_details.transaction_status', 'order_details.status')
         //    ->get();
       // dd($orders[0]->orderDetail->transaction_status);
       
         return redirect('getStatus')->with('success', 'track order!');
       
         // dd($emailid,$orderid);
         
    }
      public function getStatus(){
           $orders = Session::get('orders');
         

        return view('frontend.getstatus',compact('orders'));

      }
      
   



}
