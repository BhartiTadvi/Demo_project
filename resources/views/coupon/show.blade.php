@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Coupon {{ $coupon->id }}</div>
                    <div class="box-body">
                     <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $coupon->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Title </th>
                                        <td> {{ $coupon->title }} </td>
                                    </tr>
                                    <tr>
                                        <th> Code </th>
                                        <td> {{ $coupon->code }} </td>
                                    </tr>
                                    <tr>
                                        <th> Type </th>
                                        <td> {{ $coupon->type }} </td>
                                    </tr>
                                    <tr>
                                        <th> Quantity </th>
                                        <td> {{ $coupon->quantity }} </td>
                                    </tr>
                                </tbody>
                            </table>
                              <a href="{{ route('coupon.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
