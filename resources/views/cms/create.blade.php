@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="box">
                    <div class="box-header">Create New cm</div>
                    <div class="box-body">
                        
                        <br />
                        <br />
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('cms.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('cms.form', ['formMode' => 'create'])
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
 <script>
        CKEDITOR.replace( 'pagecontent' );
    </script>
@endsection