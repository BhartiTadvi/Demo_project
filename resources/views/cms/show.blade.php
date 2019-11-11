@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">CMS {{ $cm->id }}</div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                     <th>ID</th><td>{{ $cm->id }}</td>
                                    </tr>
                                    <tr><th> Type </th>
                                    <td> {{ $cm->type }} </td>
                                    </tr>
                                    <tr><th> Description </th>
                                    <td>  {!! $cm->description !!} </td>
                                    </tr>
                                    <tr>
                                        <th> Status </th>
                                        <td> {{ $cm->status }} </td>
                                    </tr>
                                </tbody>
                            </table>
                             <a href="{{ route('cms.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
