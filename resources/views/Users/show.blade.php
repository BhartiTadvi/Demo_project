@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        </div><br/>
        <div class="pull-left" style="margin-left:10px">
            <h2> Show User</h2>
        </div>
    </div>
</div>
<div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="box">
            <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="margin-left: 54px;
    margin-top: 11px;">
            <strong>Name:</strong>
            {{ $user->name }}
            </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group" style="margin-left: 56px;">
            <strong>Image:</strong>
            <img src="{{asset('storage/'.Auth::user()->image )}}" class="user-image" alt="User Image" height=77px>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group" style="margin-left: 56px;">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group" style="margin-left: 56px;">
            <strong>Passsword</strong>
            {{ $user->password }}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group" style="margin-top: -5px;
    margin-left: 56px;">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
    <a class="btn btn-warning" href="{{ route('Users.index') }}" style="margin-left: 22px;
    margin-top: 6px;"> Back</a>
</div>
</div>
</div>
</div>
</div>
@endsection