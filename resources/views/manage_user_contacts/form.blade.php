 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($manage_user_contact->name) ? $manage_user_contact->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($manage_user_contact->email) ? $manage_user_contact->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
</div>

 <div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    <label for="subject" class="control-label">{{ 'Subject' }}</label>
    <input class="form-control" name="subject" type="text" id="subject" value="{{ isset($manage_user_contact->subject) ? $manage_user_contact->subject : ''}}" >
    {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="message" class="control-label">{{ 'Message' }}</label>
    <input class="form-control" name="message" type="text" id="message" value="{{ isset($manage_user_contact->message) ? $manage_user_contact->message : ''}}" >
    {!! $errors->first('message', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">
    <label for="note" class="control-label">{{ 'Note' }}</label>
    <textarea name="note" class="form-control"> </textarea>
{!! $errors->first('note', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    <a href="{{ route('manage_user_contacts.index') }}" title="Back" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
</div>
</div>

