@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Create New Product</div>
                    <div class="box-body">
                        
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/products') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('products.form', ['formMode' => 'create'])
                         </form>
                          </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
 <script type="text/javascript">
     $('#category').on('change',function(e){
       
         var cat_id = e.target.value;
    // alert(cat_id);
     $.ajax({
        data: {'category_id':cat_id},
        type: 'get',
        url: "{{route('getSubCategory')}}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
         //console.log(response);
            $('#subcategory').empty();

             $('#subcategory').append(' Please choose one');

             $.each(response, function(index, subcatObj){

            $('#subcategory').append('<option value="' + subcatObj.id + '">' + subcatObj.name + '</option>');
           });


            // $('#category_meal_list').replaceWith(response); 

        }
      });

     });


    
  
  </script>



@endsection