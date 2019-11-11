@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="box">
                    <div class="box-header">Create New Privecy</div>
                    <div class="box-body">
                        <form method="POST" action="{{ url('/privecy') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                        <label for="type" class="control-label">{{ 'Type' }}</label>
                        <input class="form-control" name="type" type="text" id="type">
                        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                    </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="control-label">{{ 'Description' }}</label>
                        <textarea class="form-control" name="description" type="text" id="description"> </textarea>
                        
                        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                    </div>
                    </div>
                   <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="form-group">
                     <label style="margin-left: 18px;}"> Active </label>
                     <input type="radio" name="status" value="1" class="minimal-red" checked>

                     <label> Inactive </label>
                     <input type="radio" name="status" value="0" class="minimal-red"></div>
                      {!! $errors->first('status', '<p class="check-error">:message</p>') !!}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="create">
                        <a href="{{ url('/privecy') }}" class="btn btn-warning btn-sm" title="Back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </div>
                    </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
