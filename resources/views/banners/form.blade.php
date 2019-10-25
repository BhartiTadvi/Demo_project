<div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
	<div class="form-group">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($banner->name) ? $banner->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('image') ? 'has-error' : ''}}">
	<div class="form-group">

    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ isset($banner->image) ? $banner->image : ''}}" style="border: hidden;">
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">

<a href="{{ route('banners.index') }}" title="Back" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
</div>



