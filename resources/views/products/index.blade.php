@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-11">
                <div class="box">
                  <div class="box-header">products</div>
                      <div class="box-body">
                        <div class="pull-right">
                          @can('product_create')
                        <a href="{{ route('products.create') }}" class="btn btn-success   btn-sm" title="Add New Product">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                      </a>
                       @endcan
                 </div>
                  <form method="GET" action="{{ route('products.index') }}"  accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                 <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                </div>
                  <span class="">
                  <button class="btn btn-secondary" type="submit">
                   <i class="fa fa-search"></i>
                  </button>
              </span>
             </form>
           @if ($message = Session::get('success'))
           <div class="alert alert-success">
            <p>{{ $message }}</p>
           </div>
          @endif
              <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Productname</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $item)
                               
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->productname }}</td><td>{{ $item->price }}</td>
                                        <td>{{ $item->description }}
                                        </td>
                                       
                                        <td>
                                            @can('product_show')
                                            <a href="{{ route('products.show', $item->id) }}" title="View Product"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @endcan
                                            @can('product_edit')
                                            <a href="{{ route('products.edit', $item->id) }}" title="Edit Product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endcan
                                            
                                            @can('product_delete')
                                            <form method="POST" action="{{ route('products.destroy', $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                           <div class="pagination-wrapper"> {!! $products->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
