@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-md-11">
                <div class="box">
                    <div class="box-header">Banner </div>
                    <div class="box-body">

                        <a href="{{ url('/banners') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                       
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $banner->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $banner->name }} </td></tr>

                                     <tr><th> Banner </th><td><img src="{{asset('storage/'.$banner->image)}}" height="50" width="50"></td></tr>
                               </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
