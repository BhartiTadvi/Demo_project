@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Create New manage_user_contact</div>
                    <div class="box-body">
                        <a href="{{ route('manage_user_contacts.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('manage_user_contacts.store') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('manage_user_contacts.form', ['formMode' => 'create'])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
