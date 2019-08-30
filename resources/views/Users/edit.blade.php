@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
         <div class="pull-left">
            <a class="btn btn-primary" href="{{ route('Users.index') }}" style="margin-left: 11px;
    margin-top: 11px;"> Back</a>
        </div><br/>
        <div class="pull-left">
            <h2>Edit New User</h2>
        </div>
       
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
<div class="container">
        <div class="row">
           
            <div class="col-md-9">
                <div class="box">
                    
                    <div class="box-body">
    

{!! Form::model($user, ['method' => 'PATCH','route' => ['Users.update', $user->id],'enctype'=>'multipart/form-data']) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="file" id="image">
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>


@endsection