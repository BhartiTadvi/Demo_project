@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Edit CMS #{{ $cm->id }}</div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('cms.update',$cm->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate="parsley">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            @include ('cms.form', ['formMode' => 'edit'])
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
