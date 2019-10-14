@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">order_management {{ $order_management->id }}</div>
                    <div class="box-body">

                        <a href="{{ url('/order_management') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/order_management/' . $order_management->id . '/edit') }}" title="Edit order_management"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('order_management' . '/' . $order_management->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete order_management" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $order_management->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Customer Details With Address </th><td> {{ $order_management->customer_details_with_address }} </td>
                                    </tr><tr><th> Ordered Products </th>
                                        <td> {{ $order_management->Ordered products }} </td>
                                    </tr>
                                    <tr>
                                        <th> Pagecontent </th>
                                        <td> {{ $order_management->pagecontent }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
