<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Address;
use Mail;
use App\Mail\OrderStatus;

class OrderManagementController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View

     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $orders = Order::where('id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
             $orders=Order::with('products','products.product','orderDetail')->latest()->paginate($perPage);
        }

        return view('order_management.index', compact('orders'));
    }

    public function orderDetail($id)
    {
      $orders=Order::with('products','products.product','orderDetail','address')->find($id);
     return view('order_management.product_details',compact('orders'));
    }
    
    public function editOrder($id)
    {
        $orderDetails=Order::with('orderDetail')->find($id);
       // dd($orderDetails->orderDetail[0]->transaction_status);
        return view('order_management.editorder',compact('orderDetails'));
    }
    public function updateOrder(Request $request,$id)
    {
        $orderDetails = Order::where('id',$id)->with('address','user','orderDetail')->first();
        // dd($orderDetails->orderDetail[0]->payment_mode);
        foreach($orderDetails->address as $address)
        {
          $address1 = $address->address1;
          $mobileno = $address->mobileno;
          $city = $address->city;
          $zipcode = $address->zipcode;
        }
        $email = $orderDetails->user->email;
        foreach($orderDetails->orderDetail as $paymentMode)
        {
             if($paymentMode->payment_mode == 1){
               $payment = "Cash on delivery";
             }
             else{
          $payment = "Paypal";
        }
        }
       
        
        $payment_mode =
        //$users = Order::where('id',$id)->with('user')->get();
        // dd($orderDetails);
        $tracking_code = str_random(12);
        $orders = OrderDetail::where('order_id',$id)->first();
        $orders->transaction_status = $request->order_status;
        $orders->save();
         $orderStatus= array(
        'status'  => $request->get('order_status'),
        'tracking_code' => $tracking_code,
        'billing_address' =>$address1,
        'billing_city' =>$city,
        'billing_zipcode' =>$zipcode,
        'billing_mobileno' =>$mobileno,
        'shipping_address' => $address1,
        'shipping_city' => $city,
        'shipping_zipcode' => $zipcode,
        'shipping_mobileno' => $mobileno,
        'payment_mode' => $payment,
        'template_key' => "shipment_template_key",
        );
        Mail::to($email)->send(new OrderStatus($orderStatus));

        return redirect()->route('order_management.index')->with('success', 'Order status updated!');
    }
}
