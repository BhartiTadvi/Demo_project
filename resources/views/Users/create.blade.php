@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
         <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        
    </div>
</div>

<div class="container">
        <div class="row">
            

            <div class="col-md-9">
                <div class="box">
                    <div class="box-header"></div>
                    <div class="box-body">
                                                  
{!! Form::open(array('route' => 'Users.store','method'=>'POST','data-parsley-validate','id'=>'create_user','class'=>'col-sm-12','enctype'=>'multipart/form-data')) !!}
{{ csrf_field() }}


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name: <span class="check-error">*</span></strong>

            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter Name ')) !!}

           {!! $errors->first('name', '<span class="error-message">:message</span>') !!}


        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:<span class="check-error">*</span></strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter email ','data-parsley-trigger'=>'change focusout')) !!}
                {!! $errors->first('email', '<span class="error-message">:message</span>') !!}


        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Image:<span class="check-error">*</span></strong>
    
    <input class="form-control" name="image" type="file" id="image">
    {!! $errors->first('image', '<span class="error-message">:message</span>') !!}

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:<span class="check-error">*</span></strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','id' => 'password1','data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter password','data-parsley-trigger'=>'change focusout')) !!}
         {!! $errors->first('password', '<span class="error-message">:message</span>') !!}

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:<span class="check-error">*</span></strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control','data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter confirm password','data-parsley-trigger'=>'change focusout','data-parsley-equalto'=>'#password1')) !!}
          {!! $errors->first('confirm-password', '<span class="error-message">:message</span>') !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Status:</strong><br/>
            <input type="radio" value="Active" name="Active" checked><label>Active</label>
            <input type="radio" value="Inactive" name="Inactive"><label>Inactive</label>

        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:<span class="check-error">*</span></strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple','data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please select role','data-parsley-trigger'=>'change focusout')) !!}
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
     
     $("#create_user").parsley();
     });
    
</script>
@endsection