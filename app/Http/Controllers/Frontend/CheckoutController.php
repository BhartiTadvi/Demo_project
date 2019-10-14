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
use App\Mail\OrderMail;
use App\EmailTemplate;
use App\Coupon;
use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{
    //
    public function index(Request $request)
    {
        //dd($request->all());

        if(Auth::user())
        {
        $product_name=$request->product_name;
        $subTotal=$request->subTotal;
        $grandTotal=$request->grandTotal;
        $ShippingCost=$request->ShippingCost;
        $coupon=$request->coupon;
        $discount_amount=$request->discountvalue;
        $coupon_id=$request->coupon_id;
      
        $count=count($product_name);
        for($i=0;$i<$count;$i++)
        {
            $cart[]= array('product_id'=> $request->product_id[$i],'product_name' => $request->product_name[$i],'product_price'=> $request->product_price[$i],
                  'quantity' => $request->quantity[$i],
                'product_image'=> $request->product_image[$i]);
        }

         $countries = Country::get();
         $states = State::get();
         $user = User::get();
         $orders  =  Order::get();
         $user_id = Auth::user()->id;
         $addresses = Address::with('country','state')->where('user_id',$user_id)->get();

        }
        else{
             return view('frontend.login');
          }
            
        return view('frontend.checkout',compact('cartDetails','countries','data','cart','user','states','addresses','coupon','orders','ShippingCost','subTotal','grandTotal','discount_amount','coupon_id'));

    }
    public function getState(Request $request){

     $country_id =$request->country_id;
    
     $countries= State::where('countryID', $country_id)
                    ->get();
    
        return Response::json($countries);
    }
    public function getBillingAddress(Request $request){

      $address_id = $request->address_id;
      $user_id = Auth::user()->id;
      $addresses = Address::with('country','state')->where('user_id',$user_id)->get();
       return view('frontend.billing', compact('addresses'));
        
    }
     
    public function getShippingAddress(Request $request){
      $user_id = $request->user_id;
      $addresses = Address::with('country','state')->get();
       return view('frontend.checkout', compact(''));

    }

    public function placeOrder(Request $request){
        $coupon=$request->coupon;

          //dd($request->all());exit;   
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
        $orders->discount_amount = $request->discount_amount;
        $orders->coupon_code_id = $request->coupon_id;
        $orders->save(); 

         $price=0;
        
        $count=count($request->product_id);
        // for($i=0;$i<$count;$i++)
        // {
        //     $productorders = new Product_Order();
        //     $orders[]= array('product_id'=> $request->product_id[$i],
        //           'order_id'=> $request->order_id[$i],
        //           'quantity' => $request->quantity1[$i]);

        //   $productorders->insert($orders);
        // }

        for($i=0;$i<$count;$i++)
        {
          $productorders = new Product_Order();
          $productorders->product_id = $request->product_id[$i];
          $productorders->order_id = $request->order_id;
          $productorders->quantity = $request->quantity1[$i];
          $productorders->save();
        }
         

         $orderdetails = new OrderDetail();
         $orderdetails->order_id =$request->order_id;
         $orderdetails->payment_mode =$request->submit;
         $codtransactionid = str_random(10);
         $orderdetails->transaction_id =$codtransactionid;
         $orderdetails->save();

        $coupons=Coupon::where('code',$coupon)->first();
        $coupons->remaining_quantity = $coupons->remaining_quantity -1;
        $coupons->save();
         

         $view = '<table border="1" cellpadding="10px" width="100%">
                    <thead>
                        <tr>
                        <th>Sr.No</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                <tbody>';
                
                foreach(Cart::content() as $row){
                    $price=$price+$row->qty*$row->price;
        $view .=
                '<tr><td>'.$i++.'</td>'.
                '<td>'.$row->name.'</td>'.
                '<td>'.$row->price.'</td>'.
                '<td>'.$row->qty.'</td>'.
                '<td>'.$row->qty*$row->price.'</td></tr>'
                                        ;
                }

        $view .=    '</tbody></table>';


         
       
         $order= array(
        'email'  => Auth::user()->email, 
        'product_no'  => $request->get('product_id'),
        'product'  => $request->get('productname'),
        'quantity' => $request->get('quantity1'),
        'price' => $request->get('price'),
        'total' => $request->get('grandtotal'),
        'billing_address' => $request->get('billing_address1'),
        'shipping_address' => $request->get('address1'),
        'created_at'  => $request->get('created_at'), 
        'paymentmode' => $request->get('paymentmode'),
        'template_key' => "order_template_key",
        'view' =>$view
        );
       

         //dd($order);
        Mail::to(Auth::user()->email)->send(new OrderMail($order));
        $email="bhartitadvi081@gmail.com";
        Mail::to($email)->send(new OrderMail($order));
         
        return redirect('thanks')->with('flash_message', 'order has been placed successfully');
        
    }
    public function cashOnDelivery(){

      return view('frontend.thanks');

    }

}

 