@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            

            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Create New Category</div>
                    <div class="box-body">
                       
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    <form method="POST" action="{{ url('/category') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                         <div class="col-xs-12 col-sm-12 col-md-12 {{ $errors->has('name') ? 'has-error' : ''}}">
                            <div class="form-group">
                                <label style="margin-left:2px" for="name" class="control-label">{{ 'Main Category' }}</label>
                                <input class="form-control" name="category_name" type="text" id="name" value="{{ isset($category->name) ? $category->name : ''}}" style="" >
                                 {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">

    <label style="margin-left: 18px;}"> Active </label>

          <input type="radio" name="status" value="1" class="minimal-red">
    <label> Inactive </label>
           <input type="radio" name="status" value="0" class="minimal-red">
              
                
</div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <input class="btn btn-primary" type="submit">
                             <a href="{{ url('/category') }}" title="Back">
                            <a href="{{ url('/category') }}" title="Back" class="btn btn-warning" role="button">    Back</a>
                        </div>

                     </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
