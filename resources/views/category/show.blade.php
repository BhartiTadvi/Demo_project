@extends('layouts.app')

 @section('content')
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Subcategory
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             </div>
             <a href="{{ url('/category') }}" title="Back"><button class="btn btn-warning btn-sm" style="margin-left: 13px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
              <div class="box-header"><strong>Category Name -</strong>
                    {{ $categories->name }}</div>
                    <div class="box-body">
          <!-- /.box-header -->
                      <div class="box-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subcategory Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                               @foreach($categories->children as $child)
                              <tr>
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                        <td>{{ $child->name }}</td>
                                  
                                  <td>
                                            
                                            
                          <a href="{{ url('/category/' . $child->id . '/edit') }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        
                                            <form method="POST" action="{{ url('/category' . '/' . $child->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Category" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                           
                                             

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>


                                
                            </table>

                        </div>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
           
        <!-- /.modal -->

          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  
  <!-- /.content-wrapper -->
 @endsection