@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="box">
                  <div class="box-header">banners</div>
                      <div class="box-body">
                        <div class="pull-right">
                        <a href="{{ url('/banners/create') }}" class="btn btn-success   btn-sm" title="Add New Banner">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                      </a>
                 </div>
                  <form method="GET" action="{{ url('/banners_management') }}"  accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Banner Name</th><th>Image</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name}}</td>
                                        <td>
                                        <img src="{{asset('storage/'.$item->image)}}" height="50" width="80">
                                        </td>
                                     <td>
                                            @can('banner-list')

                                            <a href="{{ url('/banners/' . $item->id) }}" title="View Banner"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @endcan
                                            @can('banner-edit')
                                            <a href="{{ url('/banners/' . $item->id . '/edit') }}" title="Edit Banner"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endcan

                                            @can('banner-delete')

                                            <form method="POST" action="{{ url('/banners' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Banner" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">
                              {!! $banners->appends(['search' => Request::get('search')])->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
