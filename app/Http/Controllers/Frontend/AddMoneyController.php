<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

//Cart and Order model
use App\Country;
use App\State;
use App\User;
use Cart;
use App\Address;
use App\Order;
use App\OrderDetail;
use Auth;
use App\Product_Order;

class AddMoneyController extends Controller
{
     private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void

     */
    public function __construct()
    {
        //parent::__construct();
        /** setup PayPal api context **/
      $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {
        return view('frontend.paywithpaypal');
    }
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {
       // dd($request->all());
        $order_id =$request->order_id;
        Session::put('order_id',$order_id);
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
        if($address->id != 0){
            $address->name = $request->full_name;
            $address->address1 = $request->address1;
            $address->address2 = $request->address2;
            $address->country_id = $request->country;
            $address->state_id = $request->state;
            $address->city = $request->city;
            $address->zipcode = $request->zipcode;
            $address->mobileno = $request->phone;
            $address->user_id = Auth::user()->id;
            $address->save();
          }  
       
           $orders = new Order();
           $orders->user_id  = Auth::user()->id;
           $orders->address_id = $request->address_id;
           $orders->subtotal = $request->subtotal;
           $orders->order_date = now();
           $orders->discount_amount = $request->discount_amount;
           $orders->total = $request->grandtotal;
           $orders->shipping_charge = $request->shippingcost;
            $orderId =$orders->id;
           $orders->save(); 
       
        $count=count($request->product_id);
        for($i=0;$i<$count;$i++)
        {
          $productOrders = new Product_Order();
          $productOrders->product_id = $request->product_id[$i];
          $productOrders->order_id = $orderId;
          $productOrders->quantity = $request->quantity1[$i];
          $productOrders->save();
        }
         
          $orderDetails = new OrderDetail();
          $orderDetails->order_id =$orderId;
          $orderDetails->payment_mode =$request->submit;
          $orderDetails->save();
            
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('INR')
            ->setQuantity(1)
            ->setPrice($request->get('grandtotal')); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        
        $amount = new Amount();
        $amount->setCurrency('INR')
            ->setTotal($request->get('grandtotal'));
           
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
       
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('addmoney.paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('addmoney.paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
      Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        return Redirect::route('addmoney.paywithpaypal');
    }
    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('addmoney.paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        
        if ($result->getState() == 'approved') { 
          $order_id= Session::get('order_id');
          $orderDetails =new OrderDetail();
          $orderDetails->order_id =$order_id;
          $orderDetails->transaction_id = $result->id;
          $orderDetails->save();
         
            \Session::put('success','Payment success');
            return Redirect::route('addmoney.paywithpaypal');
        }
        \Session::put('error','Payment failed');
        return Redirect::route('addmoney.paywithpaypal');
    }
}



