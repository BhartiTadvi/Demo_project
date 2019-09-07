@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Product {{ $products->id }}</div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $products->product_image }}</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <a href="" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection
