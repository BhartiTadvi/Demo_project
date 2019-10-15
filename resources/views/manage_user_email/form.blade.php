<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($manage_user_email->name) ? $manage_user_email->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('address1') ? 'has-error' : ''}}">
    <label for="template_key" class="control-label">{{ 'Template key' }}</label>
    <input class="form-control" name="template_key" type="text" id="template_key" value="{{ isset($manage_user_email->template_key) ? $manage_user_email->template_key : ''}}" >
    {!! $errors->first('template_key', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('address1') ? 'has-error' : ''}}">
    <label for="mailsubject" class="control-label">{{ 'Mail Subject' }}</label>
    <input class="form-control" name="mailsubject" type="text" id="mailsubject" value="{{ isset($manage_user_email->mailsubject) ? $manage_user_email->mailsubject : ''}}" >
    {!! $errors->first('mailsubject', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('template_content') ? 'has-error' : ''}}">
    <label for="template_content" class="control-label">{{ 'Template Content' }}</label>
    <textarea id="template_content" name="template_content" >
      
    </textarea>
    {!! $errors->first('template_content', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
     <a href="{{ route('manage_user_email.index') }}" title="Back" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
</div>
</div>