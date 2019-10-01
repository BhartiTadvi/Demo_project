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
								<!-- <div class="col-sm-6">
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div> -->
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
									   <li><a href="{{ url('productsinfo/'.$child->id) }}">{{ $child->name}}</a>
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
				
				<div class="col-sm-9 padding-right">

					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<!-- $productwish
 -->                        @foreach($products as $product)
                        @foreach($product->productImage as $image)
                        @endforeach
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									
										<div class="productinfo text-center">
											<img src="{{asset('uploads/'.$image->image)}}" alt="product-image" height=190px width=121px;/>
											<h2><i class="fa fa-inr"></i> {{$product->price}} </h2>
											<p>{{$product->productname}} </p>


											<a href="{{ url('/shopping-cart-add/' . $product->id) }}" id="add" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>RS {{$product->price}}</h2>
												<p></p>
												<a href="{{ url('/productdetails/' . $product->id) }}"id="add" class="btn btn-default" style="margin-top: -25px;color:#FE980F;"><i class="add-to-cart"></i>product_details</a>
												<a href="{{ url('/shopping-cart-add/' . $product->id) }}" id="add" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>

								</div>
						 <form id="wishlist" method="POST" action="{{url('/addToWishList')}}">
                                  {{ csrf_field() }}
								<div class="choose">
									<input type="hidden" name="product_id" value="{{$product->id}}">
									<ul class="nav nav-pills nav-justified">
										<li>
									<button><i class="fa fa-plus-square"></i>Add to wishlist</button>		
										<!-- <input type="submit" name="submit" value="Add to wishlist"/>	
											 -->
										<!-- <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li> -->
									</ul>
								</div>
								</form>
							</div>
						</div>
						

						@endforeach
					
						
					</div><!--features_items-->
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
						  <ul class="nav nav-tabs product_category">

                               
						  		@foreach($productCounts as $category)
								<li class="" data-id="{{$category->id}}">
									<a href="#{{$category->name}}" id="{{$category->id}}" data-toggle="tab">{{$category->name}}</a></li>
								@endforeach
								
							</ul>
						</div>

						<div class="tab-content">
							<div class="tab-pane fade active in" id="products" >
                            </div>

							
						</div>
					</div><!--/category-tab-->
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="images/home/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
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
	 // $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
     

	// $('#sl2').on('change',function(e){
 //         alert("hi");
	// 	var min_price = $(this).attr("data-slider-min");
	// 	var max_price = $(this).attr("data-slider-max");
	// 	///console.log(min_price);
	// 	$.ajax({
	// 	  type: 'get',
	//       dataType: 'html',
	//       url: '{{url('/pricefilter')}}',
	//       data: { min_price : 'min_price ', max_price : 'max_price' },
	//       success: function(response) {
 //           console.log(response);
 //           // $(".padding-right").html(response);
         
 //         }

	// 	});
	// });

	// $('#add').click(function(){
	// 	alert('hi');
	// });


	// $('#add').on('click',function(e){
 //       consloe.log('hi');
	// });
     



    });

	</script>

@endsection