@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
         <div class="col-md-11">
                <div class="box">
                    <div class="box-header">Edit Category </div>
                    <div class="box-body">
                    <form method="POST" action="{{ url('/category/' . $category->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate="parsley">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            @include ('category.form', ['formMode' => 'edit'])
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
