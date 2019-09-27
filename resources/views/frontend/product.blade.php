@foreach($products as $product)
<div class="col-sm-3">
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
				    @foreach($product->productImage as $image)
                    @endforeach
				    
					<img src="{{asset('uploads/'.$image->image)}}" alt="" width="208" height="180" />
					
						<h2>${{$product->price}}</h2>
						<p>{{$product->productname}}</p>
		        	<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
			</div>
											
		</div>
	</div>
</div>

@endforeach							
