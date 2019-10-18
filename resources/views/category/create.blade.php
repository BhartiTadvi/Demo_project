@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Create New Category</div>
                    <div class="box-body">
                     <form method="POST" action="{{ route('category.store') }}" id="create_category" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                         <div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <label style="margin-left:2px" for="name" class="control-label">{{ 'Main Category' }}</label>
                                <input class="form-control" name="category_name" type="text" id="name" value="{{ isset($category->name) ? $category->name : ''}}" data-parsley-required="true" >
                                 {!! $errors->first('category_name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="margin-left: 18px;}"> Active </label>
                     <input type="radio" name="status" value="1" class="minimal-red" checked>
                             <label> Inactive </label>
                     <input type="radio" name="status" value="0" class="minimal-red"></div>
                     <div class="col-xs-12 col-sm-12 col-md-12">
                            <input class="btn btn-primary" type="submit">
                            <a href="{{ route('category.index') }}" title="Back" class="btn btn-warning" role="button">Back</a>
                     </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

