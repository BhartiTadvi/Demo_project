@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Edit Coupon #{{ $coupon->id }}</div>
                    <div class="box-body">
                         <form method="POST" action="{{ route('coupon.update',$coupon->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <div class="col-xs-12 col-sm-12 col-md-12">
 <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" data-parsley-required="true"
    data-parsley-required-message = "Please enter title" id="title" value="{{ isset($coupon->title) ? $coupon->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Code' }}</label>
    <input class="form-control" name="code" type="text" id="code" data-parsley-required="true" data-parsley-required-message = "Please enter code" value="{{ isset($coupon->code) ? $coupon->code : ''}}" >
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="control-label">{{ 'Discount' }}</label>
    <input class="form-control" name="discount" type="number" id="discount" data-parsley-required="true" data-parsley-required-message = "Please enter discount"  value="{{ isset($coupon->discount) ? $coupon->discount : ''}}" >
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Quantity' }}</label>
    <input class="form-control" name="quantity" type="text" id="quantity" data-parsley-required="true" data-parsley-required-message = "Please enter quantity"   value="{{ isset($coupon->quantity) ? $coupon->quantity : ''}}" >
    {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
     <select class="form-control" name="type" id="type"data-parsley-required="true" data-parsley-required-message = "Please enter type">
        
     <option value="">Select type</option>
     <option value="0" @if($coupon->type == 0) selected="selected" @endif>Amount</option>
     <option value="1" @if($coupon->type == 1) selected="selected" @endif>percentage</option>
     </select>
   {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <input class="btn btn-primary" type="submit" value="edit">
    <a href="{{ route('coupon.index') }}" title="Back" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
</div>
</div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
