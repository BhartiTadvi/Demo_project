@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Role</h2>
        </div>
    </div>
</div>
<div class="container">
        <div class="row">
             <div class="col-md-9">
                <div class="box">
                    <div class="box-body">
{!! Form::model($role, ['method' => 'PATCH','route' => ['Roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            {!! $errors->first('name', '<span class="error-message">:message</span>') !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong><br/>
             <input type="checkbox" class="checkbox1"  id="checkboxall" /> 
           <label>Select all</label>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
            {!! $errors->first('permission', '<span class="error-message">:message</span>') !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-warning" href="{{ route('Roles.index') }}"> Back</a>
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#checkboxall").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
});
  });
</script>

@endsection