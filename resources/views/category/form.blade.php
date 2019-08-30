
         
<div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
 <div class="form-group">

    <label style="margin-left:29px" for="name" class="control-label">{{ 'Main Category' }}</label>
    <input class="form-control" name="category_name" type="text" id="name" value="{{ isset($category->name) ? $category->name : ''}}" style="" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
 <div class="form-group">

    <label> Active </label>

          <input type="radio" name="status" value="1" {{ ($category->status=="1")? "checked" : "" }}  class="minimal-red">
    <label> Inactive </label>
           <input type="radio" name="status" value="0" {{ ($category->status=="0")? "checked" : "" }} class="minimal-red">
              
                
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
 