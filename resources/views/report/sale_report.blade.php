@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">Sales Report</div>
                    <div class="box-body">
                        <form method="GET" action="{{ route('report.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            </div>
                             <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                            </span>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                         <th >Product Id</th>
                                        <th>Product Name</th>
                                        <th>Total Quantity</th>
                                         <th>Unit price</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($products as $product)
                                    <tr>
                                        <td>
                                          {{$product->id}}
                                        </td>
                                        <td >
                                     
                                         {{$product->productname}}
                                    
                                        </td>
                                        <td>
                                       {{ $product->count() }}

                                        </td>
                                        <td>
                                        {{ $product->price }}
                                        </td>
                                        
                                    </tr>
                                       @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $products->appends(['search' => Request::get('search')])->render() !!}  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
