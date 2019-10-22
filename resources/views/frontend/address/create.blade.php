@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
              <div class="card">
                 <div class="title text-center">Create New address</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/address') }}" accept-charset="UTF-8" class="form-horizontal"  data-parsley-validate="parsley" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('frontend.address.form', ['formMode' => 'create'])
                        </form>
                    </div>
                </div>
            </div>
           <div class="col-md-2"></div>
        </div>
    </div>
@endsection
@section('script')
 <script type="text/javascript">
     
     $('#country').on('change', function(e){

    var country_id = e.target.value;

    console.log(country_id);
    $.get('/get/states/?country_id=' + country_id, function(response){
    $('#state').empty();
    $.each(response, function(index, stateObj){
    $('#state').append('<option value="'+ stateObj.id +'">'+ stateObj.state_name+'</option>');
      });
     });
 });
  </script>
@endsection
