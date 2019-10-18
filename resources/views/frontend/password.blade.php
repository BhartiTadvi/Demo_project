@extends('frontend.layouts.master')
@section('content')
<section>
  <div class="container">
    <div class="row profile">
    <div class="col-md-3">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
          <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
        </div>
        @include('frontend.sidebar')
        <!-- END MENU -->
      </div>
    </div>
      @if ($message = Session::get('success'))
           <div class="alert alert-success">
            <p>{{ $message }}</p>
           </div>
          @endif
   <div class="col-md-9">
           <p class="trackorder">Change password</p>
      <div class="col-md-2"></div>
    <div class="profile-content col-md-6">
       {!! Form::open(array('route' => 'changepassword','method'=>'POST','data-parsley-validate','id'=>'login-user','enctype'=>'multipart/form-data')) !!}
                    {{ csrf_field() }}
                     <div class="form-group col-md-12">
                        <input type="password" name="current_password" class="form-control"  placeholder="Current Password" data-parsley-required="true" data-parsley-required-message ="Please enter password">
                        {!! $errors->first('current_password', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group col-md-12">
                        <input type="password" name="new_password" class="form-control" id="newPassword"  placeholder="New Password" data-parsley-required="true" data-parsley-required-message ="Please enter new password">
                        {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group col-md-12">
                        <input type="password" name="confirm_password" class="form-control" placeholder=" Confirm Password" data-parsley-required="true" data-parsley-required-message ="Please enter confirm password" data-parsley-equalto="#newPassword">
                        {!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
                    </div>
                                         
                    <div class="form-group col-md-12">
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Update">
                    </div>
               {!! Form::close() !!}

    </div>
  </div>
</div>
</section>


@endsection