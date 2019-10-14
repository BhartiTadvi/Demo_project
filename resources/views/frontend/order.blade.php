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
                                        <th class="order">Date</th>
                                         <th class="order">Order Status</th>
                                        <th class="order">Order Details</th>
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
                                          {{$order->created_at}}
                                        </td>
                                        <td class="order">
                                        @foreach($order->orderDetail as $status)
                                          {{$status->transaction_status}}
                                          @endforeach
                                        </td>
                                        <td>  
                                          <a href="{{ url('/show-order/' . $order->id) }}" title="View Product"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Order Details</button></a> 
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