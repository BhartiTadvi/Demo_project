<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;
use App\User;
use App\address;
use Cart;
use Auth;
use Session;
use App\Order;
use App\Product_Order;
use App\OrderDetail;



class CheckoutController extends Controller
{
    //
    public function index()
    {
        
        if(Auth::user())
        {
        $total=0;
        $data = Cart::content();

         foreach($data as $item)
         {
            $total=$total+($item->qty*$item->price);
         }
         // dd($total);
        
         Session::put('total',$total);

         $countries = Country::get();
         $states = State::get();
         $user = User::get();
         $orders  =  Order::get();
          $user_id = Auth::user()->id;

         // $data  =  Cart::content();
          $addresses = Address::with('country','state')->where('user_id',$user_id)->get();

        }
        else{
             return view('frontend.login');
          }
            //dd($addresses);
        return view('frontend.checkout',compact('countries','data','user','states','addresses','orders'));

    }
    public function getState(Request $request){

      $country_id =$request->country_id;
    
     $countries= State::where('countryID', $country_id)
                    ->get();
                             // echo '<pre>';print_r($countries);die;
        return Response::json($countries);
    }
    public function getBillingAddress(Request $request){

      $address_id = $request->address_id;
      $user_id = Auth::user()->id;
       // dd($address_id);
      $addresses = Address::with('country','state')->where('user_id',$user_id)->get();
       return view('frontend.billing', compact('addresses'));

        // return response()->json($addresses);
    }
     
    public function getShippingAddress(Request $request){
      $user_id = $request->user_id;
      $addresses = Address::with('country','state')->get();
      
        // return response()->json($addresses);
       return view('frontend.checkout', compact(''));

    }

  
    public function placeOrder(Request $request){
          
         dd($request->all());
        //dd( $request->order_id);

      
       $this->validate($request, [
            'full_name' => 'required',
            'phone' => 'required',
            'zipcode' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'name' => 'required',
            'phone_number' => 'required',
            'zip_code' => 'required',
            'country1' => 'required',
            'billing_city' =>'required',
            'state1' => 'required',
            'billing_address1' => 'required',
            'billing_address2' => 'required',
            ]);
        $countries = Country::get();
        $states = State::get();
        $user = User::get();
        $data  =  Cart::content();
       

        $address = new Address();
        $addresses = Address::get();

        if($address->id != 0)
         {
         $address->name = $request->full_name;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->city = $request->city;
        $address->zipcode = $request->zipcode;
        $address->mobileno = $request->phone;
         
        $address->name = $request->name;
        $address->address1 = $request->billing_address1;
        $address->address2 = $request->billing_address2;
        $address->country_id = $request->country1;
        $address->state_id = $request->state1;
        $address->city = $request->billing_city;
        $address->zipcode = $request->zip_code;
        $address->mobileno = $request->phone_number;
        $address->user_id = Auth::user()->id;
         $address->save();
         }  


        $orders = new Order();
        $orders->user_id  = Auth::user()->id;
        $orders->address_id = $request->address_id;
        $orders->subtotal = $request->subtotal;
        $orders->total = $request->grandtotal;
        $orders->shipping_charge = $request->shippingcost;
        $orders->save(); 

         $productorders = new Product_Order();
         $productorders->product_id = $request->product_id;
         $productorders->order_id = $request->order_id;
         $productorders->quantity = $request->quantity;
         $productorders->save(); 
         
         $orderdetails = new OrderDetail();
         $orderdetails->order_id =$request->order_id;
         $orderdetails->payment_mode =$request->submit;
         
         $codtransactionid = str_random(10);

         //dd($codtransactionid);
         
         $orderdetails->transaction_id =$codtransactionid;


         $orderdetails->save();



        return redirect('thanks')->with('flash_message', 'order has been placed successfully');
        
         // return view('frontend.checkout',compact('countries','states','user','data','addresses'));
         
    
    }
    public function cashOnDelivery(){

      return view('frontend.thanks');


    }

}

 