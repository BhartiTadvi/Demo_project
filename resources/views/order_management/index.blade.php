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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Date</th>
                                         <th>Order Status</th>
                                        <th>Order Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>
                                          {{$order->id}}
                                        </td>
                                        <td>
                                          {{$order->created_at}}
                                        </td>
                                        <td>
                                        @foreach($order->orderDetail as $status)

                                          {{$status->transaction_status}}
                                          @endforeach
                                        </td>
                                        <td> 
                                          @can('order-show') 
                                          <a href="{{ route('show.orderdetail', $order->id) }}" title="View Product"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Order Details</button></a> 
                                          @endcan
                                          @can('order-edit')
                                          <a href="{{ route('edit.order',$order->id) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Order</button></a>
                                          @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                     </table>
                            <div class="pagination-wrapper"> {!! $orders->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
