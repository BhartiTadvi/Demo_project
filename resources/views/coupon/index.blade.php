@extends('layouts.master')
 @section('content')
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Coupon
        <small></small>
      </h1>
      
    </section>
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             <div class="pull-right">
              <a href="{{ route('coupon.create') }}" class="btn btn-success btn-sm" title="Add New Coupon">
               <i class="fa fa-plus" aria-hidden="true"></i> Add New
              </a>
                    
               </div><br/><br/>
            </div>
          @if ($message = Session::get('success'))
          <div class="alert alert-success">
            <p>{{ $message }}</p>
          </div>
          @endif
          <form method="GET" action="{{ route('coupon.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                </div>
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
             </form>
        @if ($message = Session::get('success'))
        <div class="success">
            <p>{{ $message }}</p>
        </div>
       @endif
        <!-- /.box-header -->
            <div class="box-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Discount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($coupon as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->discount }}</td>

                                        <td>
                                            <a href="{{ route('coupon.show',$item->id) }}" title="View Coupon"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ route('coupon.edit',$item->id) }}" title="Edit Coupon"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ route('coupon.destroy',$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Coupon" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                          <div class="pagination-wrapper"> {!! $coupon->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                      </div>
                    </div>
                 </div>
               </div>
          </section>
 @endsection