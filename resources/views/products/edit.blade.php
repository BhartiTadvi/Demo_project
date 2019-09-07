@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Edit Product #{{ $product->id }}</div>
                    <div class="box-body">
                       

            
         <form method="POST"  action="{{ url('/products/' . $product->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group {{ $errors->has('categoryname') ? 'has-error' : ''}}">
                    <label for="categoryname" class="control-label">{{ 'Category Name' }}</label>
                     <select class="form-control"  name="category_name" id="category"data-parsley-required="true">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    @if($category->parent_id == 0)
                    <option value={{$category->id}}@if($product->categories[0]->parent_id == $category->id) selected="selected" @endif>
                        {{$category->name}}
                    </option>
                    @endif
                    @endforeach

                    </select>
                    <!-- <input class="form-control" name="categoryname" type="text" id="productname" value="{{$product->productCategories->category->name}}" > -->
                    {!! $errors->first('productname', '<p class="help-block">:message</p>') !!}
                </div>
                </div>
         <div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('Subcategories') ? 'has-error' : ''}}">
            <div class="form-group">
                    <label for="subcategory" class="control-label">{{ 'Subcategory' }}</label>

                    <select class="form-control" name="subcategory_id" id="subcategory"data-parsley-required="true">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)

                     @if($category->parent_id != 0)
                    <option value={{$category->id}} 
                    @if($product->productCategories->category_id == $category->id) selected="selected" @endif>
                        {{$category->name}}
                    </option>
                    @endif
                    @endforeach
                    </select>
            </div>
        </div>
                                    
                                    


                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group {{ $errors->has('productname') ? 'has-error' : ''}}">
                    <label for="productname" class="control-label">{{ 'Product Name' }}</label>
                    <input class="form-control" name="productname" type="text" id="productname" value="{{ isset($product->productname) ? $product->productname : ''}}" >
                    {!! $errors->first('productname', '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                    <label for="price" class="control-label">{{ 'Price' }}</label>
                    <input class="form-control" name="price" type="number" id="price" value="{{ isset($product->price) ? $product->price : ''}}" >
                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    <label for="description" class="control-label">{{ 'Description' }}</label>
                    <input class="form-control" name="description" type="text" id="description" value="{{ isset($product->description) ? $product->description : ''}}" >
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                    @foreach($product->productImage as $image)
                      <img src="{{asset('uploads/'.$image->image)}}" height="100px" width="100px">  
                         
                    @endforeach
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                    <label for="image" class="control-label">{{ 'Image' }}</label>
                    <input class="form-control" name="image[]" type="file" id="image" value="{{ isset($product_image->image) ? $product_image->image : ''}}"  accept="image/*" /  multiple>
                    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                 </div>  
                 </div> 



                <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="update">

                <a href="{{ url('/products') }}" title="Back" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
                </div>


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
       //alert('hi');
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
          console.log(response);
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