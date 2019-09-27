@extends('frontend.layouts.master')
@section('content')
<section>
  <div class="container">
    <div class="row profile">
    <div class="col-md-3">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
          <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
        </div>
        @include('frontend.sidebar')
        <!-- END MENU -->
      </div>
    </div>
    <div class="col-md-9">
            <div class="profile-content">
                   <table class="table">
                                <thead>
                                    <tr>
                                        <th class="order">Order No</th>
                                        <th class="order">Product Name</th>
                                        <th class="order">Product Image</th>
                                        <th class="order">Product Price</th>
                                        <th class="order">Status</th>
                                        <th class="order">Product Quantity</th>
                                        <th class="order">Shipping Charge</th>
                                        <th class="order">Total</th>


                                    </tr>
                                </thead>
                                  @foreach($orders as $order)
                                  @foreach($order->products as $orderproduct)
                                  
                                  @endforeach
                                <tbody>
                                    <tr>
                                        <td class="order">
                                          {{$order->id}}
                                        </td>
                                        <td class="order">
                                           {{$orderproduct->product->productname}}
                                        </td>
                                        <td class="order">
                                           @foreach($orderproduct->product->productImage as $productimage)
                                            @endforeach
                                           <img src="{{asset('uploads/'.$productimage->image)}}" height="84" width="85">
                                        </td>
                                        <td class="order">
                                          {{$orderproduct->product->price}}
                                        </td>
                                        <td class="order">
                                         
                                        </td>
                                        <td class="order">
                                           {{$orderproduct->quantity}}
                                        </td>
                                        <td class="order">
                                          {{$order->shipping_charge}}
                                        </td>
                                        <td class="order">
                                          {{$order->total}}
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                     </table>
            </div>
    </div>
  </div>
</div>
</section>


@endsection