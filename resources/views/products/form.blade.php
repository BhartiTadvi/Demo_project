
 <div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('products') ? 'has-error' : ''}}">
    <div class="form-group">
                    <label for="category" class="control-label">{{ 'Category' }}</label>
            <select class="form-control" name="category_name" id="category"data-parsley-required="true" data-parsley-required-message = "Please enter category">
                    <option value="">Select Category</option>
                        @foreach($categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                    @endforeach
            </select>
</div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('Subcategories') ? 'has-error' : ''}}">
    <div class="form-group">
                    <label for="subcategory" class="control-label">{{ 'Subcategory' }}</label>
                    <select class="form-control" name="subcategory" id="subcategory"data-parsley-required="true" data-parsley-required-message = "Please enter subcategory">
                    <option value=""> </option>
                    </select>
</div>
</div>
                    
                    


<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('productname') ? 'has-error' : ''}}">
    <label for="productname" class="control-label">{{ 'Productname' }}</label>
    <input class="form-control" name="productname" type="text" id="productname" value="{{ isset($product->productname) ? $product->productname : ''}}" data-parsley-required="true" data-parsley-required-message = "Please enter product name" >
    {!! $errors->first('productname', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Price' }}</label>
    <input class="form-control" name="price" type="number" id="price" value="{{ isset($product->price) ? $product->price : ''}}" data-parsley-required="true" data-parsley-required-message = "Please enter price" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" name="description" type="text" id="description" value="{{ isset($product->description) ? $product->description : ''}}" data-parsley-required="true" data-parsley-required-message = "Please enter description" ></textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image[]" type="file" id="image" value="{{ isset($product_image->image) ? $product_image->image : ''}}" data-parsley-required="true"  accept="image/*" /  multiple>
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
 </div>  
 </div> 



<div class="col-xs-12 col-sm-12 col-md-12">

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">

<a href="{{ route('products.index') }}" title="Back" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
</div>
</div>
