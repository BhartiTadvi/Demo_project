@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Edit Privecy #{{ $privecy->id }}</div>
                    <div class="box-body">
                        
                        <form method="POST" action="{{ url('/privecy/' . $privecy->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            @include ('privecy.form', ['formMode' => 'edit'])
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
