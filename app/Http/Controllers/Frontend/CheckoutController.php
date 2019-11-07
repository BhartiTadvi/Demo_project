<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;
use App\State;
use App\User;
use App\Address;
use Cart;
use Auth;
use Session;
use App\Order;
use App\Product_Order;
use App\OrderDetail;
use App\Mail\OrderMail;
use App\EmailTemplate;
use App\Coupon;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    /** Get cart details from cart **/
    public function test()
    {
      if(Auth::user()){
      $total=0;
      foreach(Cart::content() as $item)
         {
            $total=$total+($item->qty*$item->price);
         }
      $countries = Country::get();
      $states = State::get();
      $user = User::get();
      $orders  =  Order::get();
      $user_id = Auth::user()->id;
      $orders  =  Order::get();
      $addresses = Address::with('country','state')->where('user_id',$user_id)->get();
       }else{
             return view('frontend.login');
          }
       return view('frontend.checkout',compact('countries','user','states','addresses','orders'));

    }
    public function index(Request $request)
    {
        if(Auth::user())
        {
        $product_name=$request->product_name;
        $subTotal=$request->subTotal;
        $grandTotal=$request->grandTotal;
        $ShippingCost=$request->ShippingCost;
        $coupon=$request->coupon;
        $discount_amount=$request->discountvalue;
        $coupon_id=$request->coupon_id;
        $count=$product_name ? count($product_name) : 0;
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
    
    /** Get state from database **/
    public function getState(Request $request){
     $country_id =$request->country_id;
     $countries= State::where('countryID', $country_id)
                    ->get();
        return Response::json($countries);
    }

    /** Get Billing Address from database **/
    public function getBillingAddress(Request $request){
      $address_id = $request->address_id;
      $user_id = Auth::user()->id;
      $addresses = Address::with('country','state')->where('user_id',$user_id)->get();
       return view('frontend.billing', compact('addresses'));
    }

    /** Get Shipping address from database **/
    public function getShippingAddress(Request $request){
      $user_id = $request->user_id;
      $addresses = Address::with('country','state')->get();
       return view('frontend.checkout', compact(''));
    }
    
    /** store order details **/
    public function placeOrder(CheckoutRequest $request){
        $coupon_id=$request->coupon_id;
        DB::beginTransaction();
      try{
          $countries = Country::get();
          $states = State::get();
          $user = User::get();
          $data  =  Cart::content();
          $addresses = Address::where('user_id',\Auth::id())->first();
        if(!$request->address_id){
                  $addresses = new Address();
                  $addresses->name = $request->full_name;
                  $addresses->address1 = $request->address1;
                  $addresses->address2 = $request->address2;
                  $addresses->country_id = $request->country;
                  $addresses->state_id = $request->state;
                  $addresses->city = $request->city;
                  $addresses->zipcode = $request->zipcode;
                  $addresses->mobileno = $request->phone;
                  $addresses->user_id = Auth::user()->id;
                  // dd($request->all());
                  $addresses->save();

                  $address = new Address();
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
                  $addresses->id= $addresses->id;
                }  
                  $orders = new Order();
                  $orders->user_id  = Auth::user()->id;
                  if( $request->address_id){
                   $orders->address_id = $request->address_id;
                  }
                  $orders->address_id = $addresses->id;
                  $orders->subtotal = $request->subtotal;
                  $orders->total = $request->grandtotal;
                  $orders->order_date = now();
                  $orders->shipping_charge = $request->shippingcost;
                  $orders->discount_amount = $request->discount_amount;
                  $orders->coupon_code_id = $request->coupon_id;
                  $orders->save();
                  $orderId =$orders->id;
                  $price=0;
          
                  $count=count($request->product_id);
                  
                  for($i=0;$i<$count;$i++)
                  {
                    $productorders = new Product_Order();
                    $productorders->product_id = $request->product_id[$i];
                    $productorders->order_id = $orderId;
                    $productorders->quantity = $request->quantity1[$i];
                    $productorders->save();
                  }
                   $orderdetails = new OrderDetail();
                   $orderdetails->order_id =$orderId;
                   $orderdetails->payment_mode =$request->submit;
                   $codtransactionid = str_random(10);
                   $orderdetails->transaction_id =$codtransactionid;
                   $orderdetails->save();
                   
                   $coupons=Coupon::where('id',$coupon_id)->first();
                 
                   $coupons->remaining_quantity = $coupons->remaining_quantity -1;
                   $coupons->save();
                   DB::commit();

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
                '<td>'.$row->qty*$row->price.'</td></tr>';
                }
        $view .=    '</tbody></table>';
        $view .= '<div style="float:right">'.'Total:'.$row->total.'</div>';
        
         $order= array(
        'email'  => Auth::user()->email, 
        'name' => Auth::user()->name,
        'product_no'  => $request->get('product_id'),
        'product'  => $request->get('productname'),
        'quantity' => $request->get('quantity1'),
        'price' => $request->get('price'),
        'total' => $request->get('grandtotal'),
        'billing_address' => $request->get('billing_address1'),
        'billing_city' => $request->get('billing_city'),
        'billing_zipcode'=> $request->get('zip_code'),
        'billing_mobileno' =>$request->get('phone_number'),
        'shipping_address' => $request->get('address1'),
        'shipping_city' => $request->get('city'),
        'shipping_zipcode'=> $request->get('zipcode'),
        'shipping_mobileno' =>$request->get('phone'),
        'created_at'  => $request->get('created_at'), 
        'paymentmode' => $request->get('paymentmode'),
        'template_key' => "order_template_key",
        'order_id' => $orders->id,
        'view' =>$view);
        Mail::to(Auth::user()->email)->send(new OrderMail($order));
        $email="bharti08@gmail.com";
        Mail::to($email)->send(new OrderMail($order));
        return redirect()->route('cashondelivery')->with('success', 'order has been placed successfully');
         } catch (\Exception $e) {
            DB::rollback();
        }
    }
   /** Show success on placeorder**/
    public function cashOnDelivery(){
      return view('frontend.thanks');
    }
}

