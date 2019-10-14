@extends('frontend.layouts.master')
@section('content')
<section>
  <div class="container">
    <div class="row profile">
    <div class="col-md-3">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
          <img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
        </div>
          @include('frontend.sidebar')
        <!-- END MENU -->
      </div>
    </div>
   <div class="col-md-9">
      <a href="{{ url('/address/create') }}" title="View address"><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Create</button></a>
           <p class="trackorder">My Address</p>
      <div class="col-md-2"></div>
    <div class="profile-content col-md-12">
        <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Address1</th><th>Address2</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($address as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->address1 }}</td><td>{{ $item->address2 }}</td>
                                        <td>
                                            <a href="{{ url('/address/' . $item->id) }}" title="View address"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/address/' . $item->id . '/edit') }}" title="View address"><button class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                           
                                            <form method="POST" action="{{ url('/address' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete address" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

       

    </div>
  </div>
</div>
</section>
 


@endsection