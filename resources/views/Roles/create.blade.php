@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            
        </div>
    </div>
</div>
<div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-body">
{!! Form::open(array('route' => 'Roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:<span class="check-error">*</span></strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            {!! $errors->first('name', '<span class="error-message">:message</span>') !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:<span class="check-error">*</span></strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
            {!! $errors->first('permission', '<span class="error-message">:message</span>') !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-warning" href="{{ route('Roles.index') }}"> Back</a>
    </div>
</div>
{!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
