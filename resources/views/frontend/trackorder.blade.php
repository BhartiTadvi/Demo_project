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
           <p class="trackorder">Track order</p>
      <div class="col-md-2"></div>
    <div class="profile-content col-md-6">
        <form method="POST" action="{{ route('order.status') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate="parsley">
                            {{ csrf_field() }}
                    <div class="form-group col-md-12">
                        <input type="email" name="emailId" class="form-control"  placeholder="Email ID"
                        data-parsley-required="true" data-parsley-required-message ="Please enter email">
                        {!! $errors->first('emailId', '<p class="help-block">:message</p>') !!}
                    </div>
                     <div class="form-group col-md-12">
                        <input type="text" name="orderId" class="form-control" placeholder="Order ID" data-parsley-required="true"
                        data-parsley-type="digits" data-parsley-required-message ="Please enter order id">
                        {!! $errors->first('orderId', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group col-md-12">
                    </div>
              <button type="submit" name="submit" class="btn btn-primary  pull-right" id="trackorder" id="trackorder">Track Order </button>
          <div class="col-md-2">
        </div>
        
      </div>
    </div>
   
  </div>
</form>

</div>

</section>
@endsection
@section('script')
 <script type="text/javascript">
    $(document).ready(function(){
   // $('#showstatus').hide();
    
     // $("#Create").toggle();
    });

  
     
  </script>
@endsection