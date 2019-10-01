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

                            @include ('manage_user_email.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
