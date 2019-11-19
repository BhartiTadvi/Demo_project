@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="box">
               <div class="box-header">Manage report</div>
                <div class="col-md-5 orderchart">
                   {!!$orderChart->html() !!}
                </div>
                <div class="col-md-5 userchart">
                   {!! $userChart->html() !!}
                </div>
                <div class="col-md-5 couponchart">
                   {!! $couponChart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
{!! Charts::scripts() !!}
{!! $orderChart->script() !!}
{!! $couponChart->script() !!}
{!! $userChart->script() !!}
@endsection
