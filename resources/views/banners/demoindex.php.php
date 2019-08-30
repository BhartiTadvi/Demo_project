@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-md-11">
                <div class="box">

                    <div class="box-header">Banner_management</div>
                    <div class="box-body">
                         <div class="box-header">
                <div class="pull-right">
                    <a href="{{ url('/banners/create') }}" class="btn btn-success btn-sm" title="Add New Banner">
                     <i class="fa fa-plus" aria-hidden="true"></i> Add New
                   </a>
                 </div>
                  <form method="GET" action="{{ url('/banners_management') }}"  accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
              <div class="input-group">
           <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
               </div>
                <span class="">
                 <button class="btn btn-secondary" type="submit">
                   <i class="fa fa-search"></i>
                 </button>
              </span>
          </form>
        
                        <br/>
                        <br/>
                        <div class="table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                            
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Image</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banners_management as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td><img src="{{asset('storage/'.$item->image)}}" height="50" width="80"></td>
                                        <td>
                                            
                                             @can('banner-list')

                                            <a href="{{ url('/banners_management/' . $item->id) }}" title="View Banners_management"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @endcan

                                            @can('banner-edit')

                                            <a href="{{ url('/banners_management/' . $item->id . '/edit') }}" title="Edit Banners_management"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            @endcan


                                            @can('banner-delete')

                                            <form method="POST" action="{{ url('/banners_management' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Banners_management" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $banners_management->appends(['search' => Request::get('search')])->render() !!} </div>
                         </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage =2;

    if (!empty($keyword)) {
        
            $category = Category::where('name', 'LIKE', "%$keyword%")

                ->latest()->paginate($perPage);
        } else {
         $category = Category::latest()->paginate($perPage);

         $categories = Category::with('parent')->where('parent_id',0)->get();
             

              //dd($categories);

             // SELECT category_id, category_name, '' as parent FROM `categories` WHERE `parent_d` = 0 UNION SELECT c.category_id, c.category_name, P.category_name as parent FROM `categories` c INNER JOIN categories P ON c.`parent_d` = P.category_id WHERE c.`parent_d` != 0


            
        }
       
        return view('category.index', compact('category','categories'));


       
    }
