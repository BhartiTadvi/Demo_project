@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">Customers Report</div>
                    <div class="box-body">
                        <form method="GET" action="{{ route('order_management.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            </div>
                             <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                            </span>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="order">Customer  Name</th>
                                        <th class="order">Email</th>
                                         <th class="order">Register At</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                     @foreach($users as $user)
                                    <tr>
                                        <td class="order">
                                        {{ $user->name }}
                                        </td>
                                        <td class="order">
                                       {{ $user->email }}
                                        </td>
                                        <td class="order">
                                       {{ $user->created_at }}
                                        </td>
                                    </tr>
                                     @endforeach
                                </tbody>
                     </table>
                     
                            <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!}  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
