<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($cm->name) ? $cm->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($cm->title) ? $cm->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('pagecontent') ? 'has-error' : ''}}">
    <label for="pagecontent" class="control-label">{{ 'Pagecontent' }}</label>
    <textarea id="pagecontent" name="pagecontent" >
    </textarea>
    {!! $errors->first('pagecontent', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
     <a href="{{ route('cms.index') }}" title="Back" class="btn btn-warning" role="button">Back</a>
</div>
</div>
