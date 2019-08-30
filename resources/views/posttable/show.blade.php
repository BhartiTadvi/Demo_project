@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-md-9">
     <div class="card">
                    <div class="card-header">Posttable {{ $posttable->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/posttable') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/posttable/' . $posttable->id . '/edit') }}" title="Edit Posttable"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('posttable' . '/' . $posttable->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Posttable" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $posttable->id }}</td>
                                    </tr>
                                    <tr><th> Productname </th><td> {{ $posttable->productname }} </td></tr><tr><th> Price </th><td> {{ $posttable->price }} </td></tr><tr><th> Description </th><td> {{ $posttable->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
