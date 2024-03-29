@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
         <div class="col-md-11">
                <div class="box">
                  <div class="box-header">Edit Category </div>
                   <table class="table">
                                <tbody>
                                  <tr>
                                        <th>Order ID</th>
                                        <td>{{$orderDetails->id}}</td>
                                    </tr>
                                    <tr>
                                        <th> Order Subtotal </th>
                                         <td> {{$orderDetails->subtotal}} 
                                         </td>
                                    </tr>
                                    <tr>
                                        <th> Order Total </th>
                                        <td>{{$orderDetails->total}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Order Date</th>
                                        <td> {{$orderDetails->created_at}} </td>
                                    </tr>
                                    <tr>
                                        <th> Order Status </th>
                                        @foreach($orderDetails->orderDetail as $order)
                                        <td> {{ $order->transaction_status }} </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                   </tr>
                                </tbody>
                     </table>                 
                    <div class="box-body">
                    <form method="POST" action="{{route('update.order',$orderDetails->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate="parsley">
                            {{ csrf_field() }}
                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="Status" class="control-label">{{ 'Order Status' }}</label>
                        <select class="form-control" name="order_status">
                        <option value="">Select Status</option>
                        <option value="pending" @if($order->transaction_status == 'pending') selected="selected" @endif>pending</option>
                        <option value="processing" @if($order->transaction_status == 'processing') selected="selected" @endif>processing</option>  
                        <option value="dispatched" @if($order->transaction_status == 'dispatched') selected="selected" @endif>dispatched</option>
                        <option value="delivered" @if($order->transaction_status == 'delivered') selected="selected" @endif>delivered</option>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <input class="btn btn-primary"  style="margin-top: 16px;" type="submit" value="Update">
                      <a href="{{ route('order_management.index') }}" title="Back" class="btn btn-warning" style="margin-top: 16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div> 
                </div>
                </form>
             </div>

         </div>
      </div>
     </div>
 </div>
@endsection
