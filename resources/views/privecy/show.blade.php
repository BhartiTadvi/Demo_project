@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Privecy {{ $privecy->id }}</div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $privecy->id }}</td>
                                    </tr>
                                    <tr><th> Type </th><td> {{ $privecy->type }} </td></tr><tr><th> Description </th><td>  {!! $privecy->description !!} </td></tr><tr><th> Status </th><td> {{ $privecy->status }} </td></tr>
                                </tbody>
                            </table>
                             <a href="{{ url('/privecy') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
