@extends('layouts.master')
 @section('content')
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category
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
              @can('category_create')
              <a href="{{ route('create.subcategory') }}" class="btn btn-success btn-sm" title="Add New Category">
                <i class="fa fa-plus" aria-hidden="true"></i> Add Subcategory
                </a>
              @endcan
               </div><br/><br/>
              <div class="top" style="margin-top: -40px;
                margin-left: 758px;">
                 @can('category_create')
                 <a href="{{ route('category.create') }}" class="btn btn-success btn-sm" title="Add New Category">
                 <i class="fa fa-plus" aria-hidden="true"></i> Add Category
                </a>
                 @endcan
              </div>
             </div>
          <form method="GET" action="{{ route('category.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    @if($item->status== 1)
                                    <td>Active</td>
                                     @else
                                    <td>Inactive</td>
                                        @endif<td>
                                    @can('category_edit')

                                    <a href="{{ route('category.edit',$item->id) }}" title="Edit Category">
                                          <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                     </a>
                                    @endcan
                                    @can('category_delete')
                                     <form method="POST" action="{{ route('category.destroy',$item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Category" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    </form>
                                     @endcan
                                     
                                      @can('category_show')
                                        <a href="{{ route('category.show', $item->id) }}" title="View Category">
                                              <button class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> </button>
                                        </a>
                                      @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                          <div class="pagination-wrapper"> 
                          {!! $category->render() !!}
                        </div>
                      </div>
                    </div>
                 </div>
               </div>
          </section>
   
 @endsection