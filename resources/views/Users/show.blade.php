@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">

        <div class="pull-left">
            <a class="btn btn-primary" href="{{ route('Users.index') }}" style="margin-left: 11px;
    margin-top: 11px;"> Back</a>
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
        <div class="form-group" style="margin: 57px;
">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group" style="margin-top: -39px;
    margin-left: 56px;">
            <strong>Email:</strong>
            {{ $user->email }}
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
</div>
</div>
</div>
</div>
</div>
@endsection