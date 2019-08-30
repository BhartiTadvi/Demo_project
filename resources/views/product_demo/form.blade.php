<div class="form-group {{ $errors->has('productname') ? 'has-error' : ''}}">
    <label for="productname" class="control-label">{{ 'Productname' }}</label>
    <input class="form-control" name="productname" type="text" id="productname" value="{{ isset($product_demo->productname) ? $product_demo->productname : ''}}" >
    {!! $errors->first('productname', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Price' }}</label>
    <input class="form-control" name="price" type="number" id="price" value="{{ isset($product_demo->price) ? $product_demo->price : ''}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ isset($product_demo->description) ? $product_demo->description : ''}}" >
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
