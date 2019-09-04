@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Create New Banner</div>
                    <div class="box-body">
                         <form method="POST" action="{{ url('/banners') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                              @include ('banners.form', ['formMode' => 'create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
