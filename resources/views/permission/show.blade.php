@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Permission {{ $permission->id }}</div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $permission->id }}</td>
                                    </tr>
                                    <tr><th> Title </th>
                                        <td> {{ $permission->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Code </th>
                                        <td> {{ $permission->guard_name }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url('/permission') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
