@extends('frontend.layouts.master')
@section('content')
<section id="advertisement">
    <div class="container">
        <img src="{{asset('theme/images/shop/advertisement.jpg')}}" alt="" />
    </div>
</section>

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
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">
                        <?php
                        
                        ?> </h2>

                        @foreach($productwish as $data)
                        <div class="col-sm-4">
                           
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                       @foreach($data->product->productImage as $image)
                                       @endforeach

                                        <a href="">
                                            <img src="{{asset('uploads/'.$image->image)}}" alt="product-image" height=190px width=121px;/>
                                        </a>
                                         
                                        <h2> ${{$data->product->price}}
                                       </h2>

                                        <p><a href="">{{$data->product->productname}}</a></p>
                                        <a href="{{ url('/shopping-cart-add/' . $data->product->id) }}" id="add" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <a href="">
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>${{$data->product->price}}</h2>
                                                <p>{{$data->product->productname}}</p>
                                               <a href="{{ url('/shopping-cart-add/' . $data->product->id) }}" id="add" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div></a>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                    <li>
                                    <a href="{{url('/removeWishList')}}/{{$data->id}}" style="color:red"><i class="fa fa-minus-square"></i>Remove from wishlist</a></li>
                                    </ul>
                                </div>

                            </div>
                            
                        </div>
                         @endforeach
                       


                </div>
                <ul class="pagination">
                   
                </ul>
            </div><!--features_items-->
        </div>
    </div>
</div>
</section>
@endsection
