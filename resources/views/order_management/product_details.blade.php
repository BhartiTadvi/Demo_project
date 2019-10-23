@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">Order_management</div>
                    <div class="box-body">
                        <form method="GET" action="{{ route('order_management.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                               
                            </div>
                             <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                            </span>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                          <h3>Customer Details</h3>
                            <table class="table" style="width: 635px;">
                               @foreach($orders->address as $customerdetail)
                                <tbody>
                                  <tr>
                                        <th>Customer Name</th>
                                        <td>                                        {{$customerdetail->name}}</td>
                                    </tr>
                                     <tr>
                                        <th>Customer Address</th>
                                        <td>                                      {{$customerdetail->address1}}</td>
                                    </tr> 
                                    <tr>
                                        <th>Customer Zipcode</th>
                                        <td>                                        {{$customerdetail->zipcode}}</td>
                                    </tr> 
                                    <tr>
                                        <th>Customer Mobile no</th>
                                        <td>                                        {{$customerdetail->mobileno}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                      </table>
                          <h3>Order Details</h3>
                           <table class="table" style="width: 635px;">
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
                          <table class="table" style="width: 635px;">
                                <thead>
                                    <tr>
                                        <th class="order">Subtotal</th>
                                        <th class="order">Shipping Charge</th>
                                        <th class="order">Total</th>
                                    </tr>
                                </thead>
                                  
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
                                
                      </table>
                      <a href="{{ route('order_management.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                       
                            <div class="pagination-wrapper">   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
