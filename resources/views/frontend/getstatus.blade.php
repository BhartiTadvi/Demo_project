@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
        <div class="box" style="padding-bottom: 21px;">
             <div class="box-header orderstatus">Order Status</div>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>

                  @foreach($orders as $order)
                   @if($order->orderStatus->transaction_status == "pending")
                        <ol class="progtrckr" data-progtrckr-steps="5">
                        <li class="progtrckr-done"> Pending</li>
                        <li class="progtrckr-todo">Processing</li>
                        <li class="progtrckr-todo">Dispatched</li>
                        <li class="progtrckr-todo">Delivered</li>
                        <li class="progtrckr-todo">Cancelled</li>
                       </ol>
                       @elseif($order->orderStatus->transaction_status == "processing")
                       <ol class="progtrckr" data-progtrckr-steps="5">
                        <li class="progtrckr-done"> Pending</li>
                        <li class="progtrckr-done">Processing</li>
                        <li class="progtrckr-todo">Dispatched</li>
                        <li class="progtrckr-todo">Delivered</li>
                        <li class="progtrckr-todo">Cancelled</li>
                       </ol>
                       @else
                        <ol class="progtrckr" data-progtrckr-steps="5">
                        <li class="progtrckr-done"> Processing</li>
                        <li class="progtrckr-done">Pending</li>
                        <li class="progtrckr-done">Dispatched</li>
                        <li class="progtrckr-done">Delivered</li>
                        <li class="progtrckr-done">Cancelled</li>
                       </ol>
                       @endif
                         @endforeach
                    <div class="col-md-2"></div>
                 </div>
                     </div>
                     <a href="{{route('track.order')}}" title="Back"><button style="margin-top: 21px;" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                </div>
            </div>
          
        </div>
    </div>
@endsection
