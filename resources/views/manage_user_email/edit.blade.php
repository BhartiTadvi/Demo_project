@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
               <div class="box-header">Edit manage_user_email #{{ $manage_user_email->id }}</div>
                    <div class="box-body">
                       @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                          <form method="POST" action="{{ url('/manage_user_email/' . $manage_user_email->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($manage_user_email->name) ? $manage_user_email->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group {{ $errors->has('template_key') ? 'has-error' : ''}}">
    <label for="template_key" class="control-label">{{ 'Template Key' }}</label>
    <input class="form-control" name="template_key" type="text" id="template_key" value="{{ isset($manage_user_email->template_key) ? $manage_user_email->template_key : ''}}" >
    {!! $errors->first('mailsubject', '<p class="help-block">:message</p>') !!}
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
      {{ $manage_user_email->templatecontent }}
    </textarea>
    {!! $errors->first('template_content', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Update">
     <a href="{{ url('/manage_user_email') }}" title="Back" class="btn btn-warning"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
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
 <script>
        CKEDITOR.replace( 'template_content' );
    </script>
@endsection