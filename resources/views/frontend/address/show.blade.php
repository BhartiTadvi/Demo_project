@extends('frontend.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">address {{ $address->id }}</div>
                    <div class="box-body">

                        
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $address->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $address->name }} </td></tr><tr><th> Address1 </th><td> {{ $address->address1 }} </td></tr><tr><th> Address2 </th><td> {{ $address->address2 }} </td></tr>
                                </tbody>
                            </table>
                            <a href="{{ url('/myAddress') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
