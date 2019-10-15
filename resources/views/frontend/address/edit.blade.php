@extends('frontend.layouts.master')


@section('content')
    <div class="container">
        <div class="row">
           <div class="col-md-1"></div>
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Edit address #{{ $address->id }}</div>
                    <div class="box-body">
                       
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

       <form method="POST" action="{{ url('/address/' . $address->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

             <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                             <label for="name" class="control-label">{{ 'Name' }}</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ isset($address->name) ? $address->name : ''}}" >
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
           </div>
            <div class="form-group {{ $errors->has('address1') ? 'has-error' : ''}}">
                <label for="address1" class="control-label">{{ 'Address1' }}</label>
                <input class="form-control" name="address1" type="text" id="address1" value="{{ isset($address->address1) ? $address->address1 : ''}}" >
                {!! $errors->first('address1', '<p class="help-block">:message</p>') !!}
            </div>
        <div class="form-group {{ $errors->has('address2') ? 'has-error' : ''}}">
            <label for="address2" class="control-label">{{ 'Address2' }}</label>
            <input class="form-control" name="address2" type="text" id="address2" value="{{ isset($address->address2) ? $address->address2 : ''}}" >
            {!! $errors->first('address2', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
                <label for="country" class="control-label">{{ 'Country' }}</label>

            <select name="country_id" class="form-control" id="country" >
           @foreach($countries as $country)
                    <option value="{{$country->id}}"@if($country->id ==$address->country_id) selected="selected" @endif>{{$country->country_name}}</option>
               @endforeach
            </select>
                {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
            </div>
    <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
        <label for="state" class="control-label">{{ 'State' }}</label>
        <select name="state_id" class="form-control" id="state" >
            @foreach($states as $state)
            <option value="{{$state->id}}"@if($state->id ==$address->state_id) selected="selected" @endif">{{$state->state_name}}</option>
           @endforeach
    </select>
        {!! $errors->first('state', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    <label for="city" class="control-label">{{ 'City' }}</label>
    <input class="form-control" name="city" type="text" id="city" value="{{ isset($address->city) ? $address->city : ''}}" >
    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : ''}}">
    <label for="zipcode" class="control-label">{{ 'Zipcode' }}</label>
    <input class="form-control" name="zipcode" type="number" id="zipcode" value="{{ isset($address->zipcode) ? $address->zipcode : ''}}" >
    {!! $errors->first('zipcode', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('mobileno') ? 'has-error' : ''}}">
    <label for="mobileno" class="control-label">{{ 'Mobileno' }}</label>
    <input class="form-control" name="mobileno" type="number" id="mobileno" value="{{ isset($address->mobileno) ? $address->mobileno : ''}}" >
    {!! $errors->first('mobileno', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="update ">
    <a href="{{ url('/myAddress') }}"  class="btn btn btn-primary" title="Back"> Back</a>
</div>


                        </form>

                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
