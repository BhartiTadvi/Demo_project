
@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">

                    <div class="box-header">Create New Subcategory</div>
                    <div class="box-body">
                        
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

             <form method="POST" action="{{url('/subcategory/store')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate="parsley">
                                        {{ csrf_field() }}
                 <div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('category') ? 'has-error' : ''}}">
                    <label for="category" class="control-label">{{ 'Category' }}</label>
                    <select class="form-control" name="category_name" data-parsley-required="true">
                    @foreach($categories as $category)
                       <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                   </select>
                      {!! $errors->first('categories', '<p class="help-block">:message</p>') !!}
                </div>

                     <div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
                         <div class="form-group">

                            <label style="margin-left:17px" for="name" class="control-label">{{ 'SubCategory' }}</label>
                            <input class="form-control" name="subcategory_name" type="text" id="name" value="{{ isset($subcategory->name) ? $subcategory->name : ''}}" style="    width: 799px;margin-left: 15px;" data-parsley-required="true" >
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:10px;">

                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{ url('/category') }}" title="Back" class="btn btn-warning" role="button"> Back </a>

                    </div>
                </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

  
