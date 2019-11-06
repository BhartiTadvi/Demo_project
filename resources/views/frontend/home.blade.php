@extends('frontend.layouts.master')
@section('content')
<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner">
							@foreach($sliders as $key => $slide)
							<div class="item {{$key == 0 ? 'active' : '' }}">
								<div class="col-sm-6">
									<img src="{{asset('storage/'.$slide->image)}}" class="girl img-responsive" alt="" height=300px width= 500px; />
									<img src="images/home/pricing.png"width="300px" height="600px"  class="pricing" alt="" />
								</div>
							</div>
							@endforeach
						</div>
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
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
									   <li><a href="{{ route('product.show', ['id'=>$child->id] )}}">{{ $child->name}}</a>
									</li>
								@endif
								@endforeach
								</ul>
								</div>
								</div>
							 </div>
								@endforeach
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
							<div class="well text-center price">

								<input type="range" class="span2"  value="" data-slider-min="{{$minprice}}" data-slider-max="{{$maxprice}}" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 
								 <b class="pull-left">$0</b> <b class="pull-right">${{$maxprice}}</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
				@if ($message = Session::get('success'))
			            <p style="color:green;margin-left:200px">{{ $message }}</p>
                @endif
				<div class="col-sm-9 padding-right">
					 @if(count($products)=="0")
					 <p style="color:red;margin-left: 342px;
                     font-size: 20px;"> Product not found</p>
					 @else
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
        <!-- $productwish
 -->                    @foreach($products as $product)
                        @foreach($product->productImage as $image)
                        @endforeach
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									
										<div class="productinfo text-center">
											<img src="{{asset('uploads/'.$image->image)}}" alt="product-image" height=190px width=121px;/>
											<h2><i class="fa fa-inr"></i> {{$product->price}} </h2>
											<p>{{$product->productname}} </p>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>RS {{$product->price}}</h2>
												<p></p>
												<a href="{{
												route('product.details', ['id'=>$product->id])}}"id="add" class="btn btn-default" style="margin-top: -25px;color:#FE980F;"><i class="add-to-cart"></i>Product Details</a>
												<a href="{{route('add.cart', ['id'=>$product->id]) }}" id="add" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>

								</div>
						 <form id="wishlist" method="POST" action="{{route('add.wishlist')}}">
                                  {{ csrf_field() }}
								<div class="choose">
									<input type="hidden" name="product_id" value="{{$product->id}}">
									<ul class="nav nav-pills nav-justified">
										<li>
								<button class="btn btn-default add-to-cart"><a href="{{ route('add.cart', ['id'=>$product->id])}}" id="add" style="color:currentColor;font-size:13px" ><i class="fa fa-shopping-cart"></i>Add to cart</a></button>
								<button class="btn btn-default add-to-cart"style="font-size:13px"><i class="fa fa-plus-square"></i>Add to wishlist</button>
									</ul>
								</div>
								</form>
							</div>
						</div>
						@endforeach
					</div><!--features_items-->
					@endif
					 <div class="pagination-wrapper"> {!! $products->appends(['search' => Request::get('search')])->render() !!} </div>
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
						  <ul class="nav nav-tabs product_category">
						  		@foreach($productCounts as $key => $category)
								<li class="{{$key == '0' ? 'active' : '' }}" data-id="{{$category->id}}" >
									<a href="#{{$category->name}}" id="{{$category->id}}" data-toggle="tab">{{$category->name}}</a></li>
								@endforeach
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="products" >
		           
						@foreach($productlist as $product)
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										    @foreach($product->productImage as $image)
						                    @endforeach
											<img src="{{asset('uploads/'.$image->image)}}" alt="" width="208" height="180" />
												<h2>${{$product->price}}</h2>
												<p>{{$product->productname}}</p>
								        	<a href="{{route('add.cart', ['id'=>$product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
																	
								</div>
							</div>
						</div>

						@endforeach		
				
                            </div>
						</div>
					</div><!--/category-tab-->


					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								@foreach($recommendationProduct as $key => $product)
								<div class="item {{$key == 0 ? 'active' : '' }}" >	
									@foreach($product as $item)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													@foreach($item->productImage as $image)
													@endforeach
													<img src="{{asset('uploads/'.$image->image)}}" alt="product-image" height=208px width=127px;/>
													
											       <h2><i class="fa fa-inr"></i>  {{$item->price}} </h2>
											         <p>{{$item->productname}} </p>
													<a href="{{route('add.cart', ['id'=>$product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
											</div>
										</div>
									</div>
									@endforeach
								</div>

								@endforeach
							</div>
							
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
@endsection

@section('script')
<script>
	$('document').ready(function()
	{
	$('ul.product_category li').click(function(e)
		{
	 var category_id =$(this).attr("data-id"); 
		 $.ajax({
	      type: 'get',
	      dataType: 'html',
	      url: '{{url('/productscateory')}}',
	      data: 'category_id=' + category_id,
	      success:function(response){
	        //console.log(response);
	        $("#products").html(response);

	      }
    	   });
		});

    });

	</script>

@endsection