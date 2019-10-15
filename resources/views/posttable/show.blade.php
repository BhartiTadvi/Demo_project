@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-md-9">
     <div class="card">
                    <div class="card-header">Posttable {{ $posttable->id }}</div>
                    <div class="card-body">

                        <a href="{{ route('posttable.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                       
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $posttable->id }}</td>
                                    </tr>
                                    <tr><th> Productname </th><td> {{ $posttable->productname }} </td></tr><tr><th> Price </th><td> {{ $posttable->price }} </td></tr><tr><th> Description </th><td> {{ $posttable->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
