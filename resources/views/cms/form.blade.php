<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Type' }}</label>
    <input class="form-control" name="type" type="text" id="type" value="{{$cm->type}}" data-parsley-required="true">
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" name="description" type="text" id="description" data-parsley-required="true">{{$cm->description}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
 <div class="form-group">
  <label style="margin-left: 18px;}"> Active </label>
    <input type="radio" name="status" value="1" class="minimal-red" checked data-parsley-required="true">

    <label> Inactive </label>
  <input type="radio" name="status" value="0" class="minimal-red" data-parsley-required="true"></div>
  {!! $errors->first('status', '<p class="check-error">:message</p>') !!}
 </div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    <a href="{{ route('cms.index') }}" class="btn btn-warning btn-sm" title="Back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
</div>
</div>