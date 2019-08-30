@extends('layouts.app')

 @section('content')
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
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

           @can('role-create')
            <a class="btn btn-success" href="{{ route('Users.create') }}"> Create New User</a>
            @endcan
            </div>
             </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>User id</th>
                  <th>Firstname</th>
                  <!-- <th>Lastname</th> -->
                  <th>Email</th>
                  <!-- <th>Status </th> -->
                  <th>Roles</th>
              <th>Action</th>

                </tr>
                </thead>
                <tbody>
                
            @foreach($data as $key => $user)
                
                <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                           <td>
            @if(!empty($user->getRoleNames()))
              @foreach($user->getRoleNames() as $v)
                 <label class="badge badge-success">{{ $v }}</label>
              @endforeach
            @endif
          </td>

                
            <td>
           <a class="btn btn-info" href="{{ route('Users.show',$user->id) }}">Show</a>
           
          <a class="btn btn-success" href="{{ route('Users.edit',$user->id) }}">Edit</a>
             {!! Form::open(['method' => 'DELETE','route' => ['Users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
           {!! Form::close() !!}
           </td>
            
                </tr>
                 @endforeach
           </tbody>
                
              </table>
               {!! $data->render() !!}
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