@extends('frontend.layouts.master')


@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					@if ($message = Session::get('success'))
			            <p style="color:red">{{ $message }}</p>
                   @endif
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						{!! Form::open(array('route' => 'userlogin','method'=>'POST','data-parsley-validate','id'=>'login-user','enctype'=>'multipart/form-data')) !!}
					      {{ csrf_field() }}

						{!! Form::text('e-mail', null, array('placeholder' => 'Email Address', 'data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter Name ')) !!}
		       		    {!! $errors->first('e-mail',  '<p class="help-block"style="color:red;">:message</p>') !!}

		       		    {!! Form::password('password1', ['class' => 'form-control','placeholder'=>"Password", "",'data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter Password ']) !!}
			       	    {!! $errors->first('password1', '<p class="help-block"style="color:red;">:message</p>') !!}

							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span><br/>
							<a href="{{ route('password.request')}}">Forgot password</a>
							<button type="submit" class="btn btn-default">Login</button>
						{!! Form::close() !!}

					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
					
					{!! Form::open(array('route' => 'user.store','method'=>'POST','data-parsley-validate','id'=>'create_user','enctype'=>'multipart/form-data')) !!}
					{{ csrf_field() }}

			    	{!! Form::text('name', null, array('placeholder' => 'Name', 'data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter Name ')) !!}
		       		{!! $errors->first('name',  '<p class="help-block"style="color:red;">:message</p>') !!}
					
					{!! Form::email('email', '', ['placeholder'=>"Email Address", 'data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter email ',""]) !!}
			        {!! $errors->first('email', '<p class="help-block"style="color:red;">:message</p>') !!}
			        
			        {!! Form::password('password', ['class' => 'form-control','placeholder'=>"Password", "",'data-parsley-required'=>'true' ,'data-parsley-required-message' => 'Please enter password']) !!}
			        {!! $errors->first('password', '<p class="help-block"style="color:red;">:message</p>') !!}

			        <button type="submit" class="btn btn-default">Signup</button>
						{!! Form::close() !!}

					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	@endsection

	@section('script')
<script type="text/javascript">
    
  
</script>
@endsection
