@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="box">
                  <div class="box-header">Faqs</div>
                    <div class="box-body">
                      <div class="pull-right">
                     
                      <a href="{{route('faqs.create')}}" class="btn btn-success   btn-sm" title="Add New Banner">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                      </a>
                      
                 </div>
                  <form method="GET" action=""  accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                 <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                </div>
                  <span class="">
                  <button class="btn btn-secondary" type="submit">
                   <i class="fa fa-search"></i>
                  </button>
              </span>
             </form>
               @if ($message = Session::get('success'))
              <div class="alert alert-success">
                <p>{{ $message }}</p>
              </div>
              @endif
              <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Question no</th>
                                        <th>Question</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($faqs as $faq)
                                    <tr>
                                        <td></td>
                                        <td>{{$faq->question_no}}</td>
                                        <td>{{$faq->question}}</td>
                                         @if($faq->status== 1)
                                        <td>Active</td>
                                         @else
                                        <td>Inactive</td>
                                        @endif
                                     <td>
                                            <a href="{{route('faqs.show',$faq->id)}}" title="view faq"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            
                                            <a href="{{route('faqs.edit',$faq->id)}}" title="Edit faq"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <form method="POST" action="{{route('faqs.delete',$faq->id)}}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Banner" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                           
                                        </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
