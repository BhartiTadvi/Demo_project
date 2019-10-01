<li>Cart Sub Total<span>{{$t1}} Rs</span></li>
{{Session::put('subtotal',$t1)}}
@if($t1>500)
<li>Shipping Cost <span>0</span></li>
@else
<li>Shipping Cost <span>50 RS</span></li>

@endif
@if($t1>500)
<li>Total <span>{{$t1}} RS</span></li>
@else
<li>Total <span>{{$t1+50}} RS</span></li>

@endif


@extends('front.master')

@section('content')
<style>
    table td { padding:10px
    }</style>




<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">My Profile</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="row">
            @include('profile.menu')
            <div class="col-md-8">

                <?php /*   <table border="0" align="center">   
                  <tr>
                  <td>      <a href="{{url('/')}}/orders" class="btn btn-success">My Orders</a></td>
                  <td>      <a href="" class="btn btn-success">My Address</a></td>
                  <td>      <a href="" class="btn btn-success">Change Password</a></td>
                  </tr>
                  </table>
                 * 
                 */ ?>
                <h3><span style='color:green'>{{ucwords(Auth::user()->name)}}</span>, Welcome</h3>
              
            </div>
        </div>



    </div>
</section>
@endsection

//menu
 <div class="col-md-4 well well-sm">
                
                <ul class="nav navbar">
                    <h3 class="">Quick Links</h3>
                    <li><a href="{{url('/profile')}}">My Profile</a></li>
                    <li><a href="{{url('/orders')}}">My Orders</a></li>
                    <li><a href="{{url('/address')}}">My Address</a></li>                    
                    <li><a href="{{url('/password')}}">Change Password</a></li>
                </ul>

            </div>

            //orders
            @extends('front.master')

@section('content')
<style>
    table td { padding:10px
    }</style>



<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/profile')}}">Profile</a></li>
                <li class="active">My Order</li>
            </ol>
        </div><!--/breadcrums-->



        <div class="row">
            @include('profile.menu')
            <div class="col-md-8">
               <h3 ><span style='color:green'>{{ucwords(Auth::user()->name)}}</span>,  Your Orders</h3>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product name</th>
                            <th>Product Code</th>
                            <th>Order Total</th>
                            <th>Order Status</th>

                            <th>Details</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->created_at}}</td>
                            <td>{{ucwords($order->pro_name)}}</td>
                            <td>{{$order->pro_code}}</td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->status}}</td>
                            <td>View</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>
@endsection

//thank you
@extends('front.master')

@section('content')

<h1 align="center">{{Auth::user()->name}} Thankyou</h1>

<p class="panel-body">
    Your order has been placed</p>

@endsection

$c_id= Session::get('cart_id');
            $s_id= Session::get('shipping_address_id');
            $b_id= Session::get('billing_address_id');

            order_details::where('id', $c_id)->update(
            ['transaction_id' =>$result->id,
            'status' => "processing"]);

@if($i==1)
                            @foreach($orders as $order)
                            <h4>Order ID: {{$order->id}}</h4>
                             <h4 style="margin-left:300px;margin-top:-30px;">Order Date:{{substr($order->created_at,0,10)}} </h4><br>
                            <div id="progressbar"  >
                            <div class="form-group col-md-12">  
                                  <ul class="progressbar" >
                                    
                                    @if($order->status == "pending")
                                    <li class="active">Confirmed</li>
                                    <li class="active">Pending</li>
                                    <li>Processing</li>
                                    <li>Shipped</li>
                                    <li>Delivered</li>
                                    @elseif($order->status == "processing")
                                    <li class="active">Confirmed</li>
                                     <li class="active">Pending</li>
                                    <li class="active">Processing</li>
                                    <li>Shipped</li>
                                    <li>Delivered</li>
                                    @else
                                    <li class="active">Confirmed</li>
                                    <li>Pending</li>
                                    <li>Processing</li>
                                    <li>Shipped</li>
                                    <li>Delivered</li>
                                     @endif
                                   
                                   
                                  </ul>
                             </div>
                             </div>  

                             @endforeach
                             @endif  
                             <?php Session()->forget('i'); ?>

