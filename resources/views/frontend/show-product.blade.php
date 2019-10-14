@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Order Details</div>
                    <div class="box-body">
                        <div class="table-responsive">
                             <table class="table">
                                <thead>
                                    <tr>
                                        <th class="order">Order Name</th>
                                        <th class="order">Transaction Id</th>
                                        <th class="order">Order Image</th>
                                        <th class="order"> Order Price </th>
                                        <th class="order">Order Quantity</th>
                                    </tr>
                                </thead>  
                                  @foreach($orders->products as $productdetail)
                                <tbody>
                                    <tr>
                                        <td class="order">
                                         {{$productdetail->product->productname}}
                                        </td>
                                        <td class="order">
                                     @foreach($orders->orderDetail as $id)

                                          {{$id->transaction_id}}
                                          @endforeach
                                        </td>
                                        <td>  
                                      @foreach($productdetail->product->productImage as   $productimage)

                                        @endforeach
                                           <img src="{{asset('uploads/'.$productimage->image)}}" height="84" width="85">
                                        </td>
                                       <td class="order">
                                          {{$productdetail->product->price}}
                                        </td>
                                        <td class="order">
                                         {{$productdetail->quantity}}
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                      </table>
                          <table class="table">
                                <thead>
                                    <tr>
                                        <th class="order">Subtotal</th>
                                        <th class="order">Shipping Charge</th>
                                        <th class="order">Total</th>
                                    </tr>
                                </thead>
                                  @foreach($orders->products as $productdetail)
                                <tbody>
                                    <tr>
                                        <td class="order">
                                           {{$orders->subtotal}}
                                        </td>
                                        <td class="order">
                                          {{$orders->shipping_charge}}
                                        </td>
                                        <td class="order">
                                         {{$orders->total}}
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                      </table>
                        </div>
                        <a href="{{url('order')}}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                     </div>
                </div>
            </div>
          
        </div>
    </div>
@endsection
