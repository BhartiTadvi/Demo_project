@extends('frontend.layouts.master')
@section('content')
<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel-group category-products" id="accordian">
							@foreach($categories as $category)
								<div class="panel panel-default">
									<div class="panel-heading">
									<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordian" href="#{{$category->name}}">
								{{$category ->name}}
								<span class="badge pull-right"><i class="fa fa-plus"></i></span>
							  </a>
								</h4>
							</div>
								<div id="{{ $category->name }}" class="panel-collapse collapse">
									<div class="panel-body">
									 <ul>
									  @foreach($subcategories as $child)
									   @if($category->id == $child->parent_id)
									   <li><a href="{{ route('product.show', ['id'=>$child->id]) }}">{{ $child->name}}</a>
									</li>
								@endif
								@endforeach
								</ul>
								</div>
								</div>
							 </div>
								@endforeach
						</div><!--/category-products-->
							
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach($productCounts as $productcount)
									<li><a href="#"> <span class="pull-right">({{ $productcount->productCategories->count() }})</span>{{ $productcount->name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								@foreach($products->productImage as $image)
								@endforeach
								<img src="{{asset('uploads/'.$image->image)}}" alt="product-image" height=190px width=121px; class="zoom"/>
											<h2></h2>
								
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										 
										 @foreach($products->productImage as $image)
										  <a href="Javascript:Void(0);">
								        <img src="{{asset('uploads/'.$image->image)}}" alt="product-image" height=70px width=80px; class="productImage" name="{{$image->image}}"/></a>
								         @endforeach
										</div>
										<div class="item">
										  <a href="Javascript:Void(0);">
										  @foreach($products->productImage as $image)
								        <img src="{{asset('uploads/'.$image->image)}}" alt="product-image" height=70px width=80px;  class="productImage"/ name="{{$image->image}}">
								         </a>
								         @endforeach
										</div>
										<div class="item">
										
										  @foreach($products->productImage as $image)
										 <a href="javascript:void(0);"> 
								        <img src="{{asset('uploads/'.$image->image)}}" alt="product-image" height=70px width=80px;  id="productImage"/>
								        </a>
								         @endforeach
										</div>
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						
						
						<div class="col-sm-7">
							<div class="product-information">
								<!--/product-information-->
								<img src="" class="newarrival" alt="" />
								<h2>{{$products->productname}}</h2>
								<p>ID-{{$products->id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span><i class="fa fa-inr"></i> {{$products->price}}</span>
								<a href="{{ route('add.cart', ['id'=>$products->id]) }}" id="add" class="btn btn-fefault cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</span>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div>
					
				</div>
			</div>
		</div>
</section>
@endsection
@section('script')
<script>
	$('document').ready(function(){
		$('.productImage').click(function(){
        var image = $(this).attr("name");
         $('.zoom').attr("src",'/uploads/'+image);
		});
    });
	</script>

@endsection