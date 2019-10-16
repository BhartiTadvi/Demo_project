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

class ProfileController extends Controller
{
    /**User profile view **/
     public function index()
    {
        return view('frontend.profile');
    }
    
    /**Get user details view **/
     public function userAccount()
    {
        if(Auth::user()){
            $profile = User::get();
          }  
          else{
             return redirect()->route('loginuser')->with("success");
          }
        return view('frontend.account',compact('profile'));
    }

     /**Create trackorder view **/
     public function trackOrder()
    {
         $orders = Session::get('orders');
        return view('frontend.trackorder',compact('orders'));
    }

     /**Create show change password form **/
     public function showChangePasswordForm()
    {
        return view('frontend.password');
    }

     /**Update password **/
     public function updatePassword(Request $request)
    {
       $this->validate($request, [
        'current_password'=>'required',
        'new_password'=>'required',
        'confirm_password'=>'required|same:new_password']);
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
    
    /** User address index **/
     public function userAddress()
    {
        $user_id= Auth::id();
        $address=Address::where('user_id',$user_id)->get();
        return view('frontend.address',compact('address'));
    }

     /** Get User order from database **/
     public function getOrder()
    {
        $user_id= Auth::id();
        $orders=Order::with('products','products.product','orderDetail')->where('user_orders.user_id',$user_id)->get();
        return view('frontend.order',compact('orders'));
    }

    /** Show User order from database **/
    public function showOrder($id)
    {
        $user_id= Auth::id();
        $orders=Order::with('products','products.product','orderDetail')->where('user_orders.user_id',$user_id)->find($id);
     return view('frontend.show-product',compact('orders'));
    }

    /** Show order status from database **/
    public function orderStatus(Request $request)
    {
         $this->validate($request, [
        'emailId'=>'required',
        'orderId'=>'required' ]);
         $email=$request->emailId;
         $orderid=$request->orderId;
         $users=User::where('email',$email)->get();
         foreach($users as $user)
         {
            $user_id =$user->id;
         }
        $orders =Order::with('orderStatus')->where('user_id',$user_id)->where('id',$orderid)->get();
         Session::put('orders',$orders);
         return redirect()->route('get.status')->with('success', 'Track order!');
    }
    
     /** Get order status from database **/
    public function getOrderStatus()
     {
        $orders = Session::get('orders');
          return view('frontend.getstatus',compact('orders'));
     }
}


