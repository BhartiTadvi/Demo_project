@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left" style="margin-left: 15px;">
            <h2> Show Role</h2>
        </div>
    </div>
</div>

<div class="container">
        <div class="row">
             <div class="col-md-11">
                <div class="box">
                    <div class="box-body">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group" style="margin-left: 15px;">
            <strong>Name:</strong>
            {{ $role->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group" style="margin-left: 15px;">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
        <a class="btn btn-warning" href="{{ route('Roles.index') }}"> Back</a>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
