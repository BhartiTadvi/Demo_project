@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">manage_user_email {{ $manage_user_email->id }}</div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $manage_user_email->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Name </th>
                                        <td> {{ $manage_user_email->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> mail subject </th>
                                        <td> {{ $manage_user_email->mailsubject }} </td>
                                    </tr>
                                    <tr>
                                        <th> Template Content </th>
                                        <td>

                                         {!! $manage_user_email->templatecontent !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ url('/manage_user_email') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
