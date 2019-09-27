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
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <!-- <div class="profile-usertitle">
          <div class="profile-usertitle-name">
            Marcus Doe
          </div>
          <div class="profile-usertitle-job">
            Developer
          </div>
        </div> -->
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        @include('frontend.sidebar')
        <!-- END MENU -->
      </div>
    </div>
  
    <div class="col-md-9">
           <p class="trackorder">Track order</p>
      <div class="col-md-2"></div>
    <div class="profile-content col-md-6">

        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                    
                    <div class="form-group col-md-12">
                        <input type="text" name="emailid" class="form-control" required="required" placeholder="Email ID">
                    </div>
                     <div class="form-group col-md-12">
                        <input type="text" name="orderid" class="form-control" required="required" placeholder="Order ID">
                    </div>
                                         
                    <div class="form-group col-md-12">
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                    </div>
                </form>
  
    <div class="col-md-2"></div>
            </div>

    </div>

  </div>
</div>
</section>


@endsection