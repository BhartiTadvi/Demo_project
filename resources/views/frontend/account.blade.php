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
     <div class="col-md-9">
           <p class="trackorder">My Account</p>
      <div class="col-md-2"></div>
    <div class="profile-content col-md-6">


        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                    <div class="form-group col-md-12">
                        <input type="text" name="name" class="form-control" required="required" placeholder="Name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group col-md-12">
                        <input type="text" name="emailid" class="form-control" required="required" placeholder="Email ID" value="{{Auth::user()->email}}" readonly>
                    </div>
                     <div class="form-group col-md-12">
                        <input type="password" name="password" class="form-control" required="required" placeholder="Password" value="{{Auth::user()->password}}">
                    </div>
                                         
                    <div class="form-group col-md-12">
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Update">
                    </div>
                </form>

    </div>
  </div>
</div>
</section>


@endsection