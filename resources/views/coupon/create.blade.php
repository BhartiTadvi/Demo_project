@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
          
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Create New Coupon</div>
                    <div class="box-body">
                     <form method="POST" action="{{ url('/coupon/coupon') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" data-parsley-validate="parsley">
                            {{ csrf_field() }}

                            @include ('coupon.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
