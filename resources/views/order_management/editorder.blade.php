@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">Edit Order</div>
                    <div class="box-body">
                        
                        <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                        <div class="col-xs-12 col-sm-12 col-md-12">
                       <div class="form-group">
                        <label for="Status" class="control-label">{{ 'Order Status' }}</label>
                        <select class="form-control" name="order_status">
                        <option  value="">Select Status</option>
                         <option value="">pending</option>
                         <option value="">processing</option>  
                         <option value="">dispatched</option>
                         <option value="">delivery</option>
                         <option value="">cancelled</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                     <input class="btn btn-primary" type="submit" value="Update">
                      <a href="{{ route('order_management.index') }}" title="Back" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </div> 
                </div>
                    
                        </form>
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection