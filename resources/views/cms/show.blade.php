@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">cm {{ $cm->id }}</div>
                    <div class="box-body">
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                    <th>ID</th>
                                    <td>{{ $cm->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $cm->name }} </td></tr><tr><th> Title </th><td> {{ $cm->title }} </td></tr><tr><th> Pagecontent </th>
                                    <td> {{ $cm->pagecontent }} </td></tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('cms.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
