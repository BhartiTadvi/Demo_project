
@extends('frontend.layouts.master')
@section('content')

	    <div  class="container">
	    	<div class="col-sm-8">
	    			
	    				<h2 class="title text-center">Create new address</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
	    				{!! Form::open(array('route' => 'contact.store','method'=>'POST','data-parsley-validate','class'=>'contact-form row','name'=>'contact-form',
	    				'id'=>'main-contact-form','enctype'=>'multipart/form-data')) !!}
				            <div class="form-group col-md-9">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-9">
				                <input type="text" name="addressone" class="form-control" required="required" placeholder="Address">
				            </div>
				            
				            <div class="form-group col-md-9">
				                <input type="text" name="addresstwo" class="form-control" required="required" placeholder="Address">
				            </div>
				            <div class="form-group col-md-9">
				               <select>
				               	<option value="">
				               		Select country
				               	</option>
				               </select>
				            </div>
				            <div class="form-group col-md-9">
				                <select>
				               	<option value="">
				               		Select state
				               	</option>
				               </select>
				            </div>
				            <div class="form-group col-md-9">
				                <input type="text" name="city" class="form-control" required="required" placeholder="City">
				            </div>
				            <div class="form-group col-md-9">
				                <input type="text" name="zipcode" class="form-control" required="required" placeholder="Zip code">
				            </div>
				            <div class="form-group col-md-9">
				                <input type="text" name="mobileno" class="form-control" required="required" placeholder="Mobile No">
				            </div>
				                              
				            <div class="form-group col-md-9">

				                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
				            </div>

				        {!! Form::close() !!}
	    			</div>
	    		
	    </div>	
    
  @endsection	