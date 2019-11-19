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
     @if ($message = Session::get('payment_success'))
          <div class="success">
              <p>{{ $message }}</p>
          </div>
         @endif
     <div class="col-md-9">
           <p class="trackorder">My Account</p>
      <div class="col-md-2"></div>
    <div class="profile-content col-md-6">
    
        <form id="main-contact-form" class="contact-form row" name="contact-form" method="POST" action="{{route('change.profile',Auth::user()->id)}}">
               {{csrf_field()}}
                    <div class="form-group col-md-12">
                        <input type="text" name="name" class="form-control" required="required" placeholder="Name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group col-md-12">
                        <input type="text" name="email" class="form-control" required="required" placeholder="Email ID" value="{{Auth::user()->email}}" readonly>
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