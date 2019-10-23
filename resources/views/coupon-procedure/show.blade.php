@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">CouponProcedure {{ $couponprocedure->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/coupon-procedure') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/coupon-procedure/' . $couponprocedure->id . '/edit') }}" title="Edit CouponProcedure"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('couponprocedure' . '/' . $couponprocedure->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete CouponProcedure" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $couponprocedure->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $couponprocedure->title }} </td></tr><tr><th> Code </th><td> {{ $couponprocedure->code }} </td></tr><tr><th> Discount </th><td> {{ $couponprocedure->discount }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
