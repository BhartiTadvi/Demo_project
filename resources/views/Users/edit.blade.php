@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
        </div>
    </div>
</div>
<div class="container">
        <div class="row">
           <div class="col-md-9">
                <div class="box">
                    <div class="box-body">
{!! Form::model($user, ['method' => 'PATCH','route' => ['Users.update', $user->id], 'data-parsley-validate','enctype'=>'multipart/form-data']) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:<span class="check-error">*</span></strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','data-parsley-required'=>'true')) !!}
             {!! $errors->first('name', '<span class="error-message">:message</span>') !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:<span class="check-error">*</span></strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','data-parsley-required'=>'true')) !!}
             {!! $errors->first('email', '<span class="error-message">:message</span>') !!}
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            @if($user->image)
           <img src="{{asset('storage/'.$user->image)}}" style="width:80px; height:auto;">
           @else
           <img src="{{asset('dist/img/dummy.jpeg')}}" class="img-circle" style="width:80px; height:auto;">
           @endif
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <label for="image" class="control-label">{{ 'Image' }}<span class="check-error">*</span></label>
    <input class="form-control" name="image" type="file" id="image" style="border: hidden;">
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Status:<span class="check-error">*</span></strong><br/>
            <input type="radio" value="Active" name="Active" checked><label>Active</label>
            <input type="radio" value="Inactive" name="Inactive"><label>Inactive</label>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <strong>Password:<span class="check-error">*</span></strong>
         {!! Form::password('password',array('placeholder' => 'Password','class' => 'form-control password','id' => 'password1')) !!}
        </div>
    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:<span class="check-error">*</span></strong>
            {!! Form::password('confirmPassword', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
             <select class="form-control" name="roles[]" id="roles"data-parsley-required="true" data-parsley-required-message = "Please enter role">
                 <option value="">Select type</option>
                 @foreach($roles as $role)
                 <option value="{{$role}}" @if($role == $userRole) selected="selected" @endif> {{$role}}</option>
                 @endforeach
            </select>
            {!! $errors->first('roles', '<span class="error-message">:message</span>') !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-warning" href="{{ route('Users.index') }}"> Back</a>
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>
 @endsection
 @section('script')
<script type="text/javascript">
    $(document).ready(function(){
          $('password').on('blur',function(){
            alert('sdff');
          });
      });
</script>
@endsection