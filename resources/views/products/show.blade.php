@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Product {{ $product->id }}</div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Category name </th>
                                        <td> {{ $product->productCategories->category->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Product name </th>
                                        <td> {{ $product->productname }} </td>
                                    </tr>
                                    <tr>
                                        <th> Price </th>
                                        <td> {{ $product->price }} </td>
                                    </tr>
                                    <tr>
                                        <th> Description </th>
                                        <td> {{ $product->description }} </td>
                                    </tr>
                                     <tr>
                                        <th> Product Image </th>
                                        @foreach($product->productImage as $image)
                                        <td>
                                            <img src="{{asset('uploads/'.$image->image)}}" height="100px" width="150px">  

                                        </td>
                                        @endforeach
                                        <td> </td>
                                    </tr>
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('products.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection
