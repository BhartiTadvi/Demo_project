@extends('layouts.master')
 @section('content')
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small></small>
      </h1>
    </section>
     @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
             <div class="pull-right">
          
            <a class="btn btn-success" href="{{ route('Users.create') }}"> Create New User</a>
           
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
                <td id={{$user->id}}>{{$user->email}}</td>
                <td>
                        @if(!empty($user->getRoleNames()))
                          @foreach($user->getRoleNames() as $v)
                             <label class="badge badge-success">{{ $v }}</label>
                          @endforeach
                        @endif
               </td>
               <td>
                 @can('user_show')
                  <a class="btn btn-info" id=show_{{$user->id}}_button href="{{ route('Users.show',$user->id) }}">Show</a>
                  @endcan
                  @can('user_edit')
                  <a class="btn btn-success" id={{$user->id}}_edit href="{{ route('Users.edit',$user->id) }}">Edit
                  </a>
                  @endcan
                  @can('user_delete')
                     {!! Form::open(['method' => 'DELETE','route' => ['Users.destroy',$user->id],'style'=>'display:inline']) !!}
                      {!!Form::submit('Delete',
                       ['class' => 'btn btn-danger','id'=>'sub-id'.$user->id]) !!}
                   {!! Form::close() !!}
                   @endcan
              </td>
            </tr>
                 @endforeach
           </tbody>
            </table>
               {!! $data->render() !!}
            </div>
            <!-- /.box-body -->
          </div>
          
       </div>
        <!-- /.col -->
      </div>
@endsection