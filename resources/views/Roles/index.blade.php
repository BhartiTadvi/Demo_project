@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right">
         
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<section class="content">
     <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <form method="GET" action="{{ route('Roles.index') }}"  accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                 <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                </div>
                  <span class="">
                  <button class="btn btn-secondary" type="submit">
                   <i class="fa fa-search"></i>
                  </button>
              </span>
             </form>
              <div class="pull-right">
                    @can('role_create')
                    <a class="btn btn-success" href="{{ route('Roles.create') }}"> 
                     Create New Role</a>
                    @endcan
              </div>
           </div>
<table class="table table-bordered">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td> 
           @can('role_show')
          <a class="btn btn-info" href="{{ route('Roles.show',$role->id) }}">Show
          </a>
          @endcan
           @can('role_edit')
           <a class="btn btn-success" href="{{ route('Roles.edit',$role->id) }}">Edit</a>
           @endcan
            @can('role_delete')
                {!! Form::open(['method' => 'DELETE','route' => ['Roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
       </td>
    </tr>
    @endforeach
</table>
{!! $roles->render() !!}
</div>
</div>
</div>
@endsection
