@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
           

            <div class="col-md-11">
                <div class="box">

                    <div class="box-header"><strong>Category Name</strong>
                    {{ $categories->name }}</div>
                    <div class="box-body">

                        <a href="{{ url('/category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $categories->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Category Name </th>
                                        <td> {{ $categories->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Subcategory Name </th>
                                        <td>
                                            <ul>
                                                @foreach($categories->children as $child)
                                     <li> {{ $child->name }}
                                        <a href="{{ url('/subcategory/' . $child->id . '/edit') }}" title="Edit Subcategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('subcategory' . '/' . $child->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete subcategory" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                  </form>  

                                                </li>
                                                @endforeach
                                            </ul> 
                                        </td>
                                    </tr>
                                </tbody>
                               

                       </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
