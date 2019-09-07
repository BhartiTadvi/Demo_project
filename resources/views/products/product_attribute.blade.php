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
                                                  
{!! Form::open(array('route'=>'store_attribute','method'=>'POST','data-parsley-validate','id'=>'create_user','class'=>'col-sm-12','enctype'=>'multipart/form-data')) !!}
{{ csrf_field() }}


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Price: <span class="check-error">*</span></strong>

            {!! Form::text('price', null, array('placeholder' => 'Price','class' => 'form-control', 'data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter Size ')) !!}

           {!! $errors->first('name', '<span class="error-message">:message</span>') !!}


        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Quantity:<span class="check-error">*</span></strong>
            {!! Form::text('quantity', null, array('placeholder' => 'Quantity','class' => 'form-control','data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter quantity ','data-parsley-trigger'=>'change focusout')) !!}
                {!! $errors->first('email', '<span class="error-message">:message</span>') !!}


        </div>
    </div>
     <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
       
            
         
            <a class="btn btn-warning" href=""> Back</a>
       
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
     
    });
    
</script>
@endsection