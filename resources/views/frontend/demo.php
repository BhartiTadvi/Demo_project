							@foreach($sliders as $slide)
								<div class="col-sm-6">
									<img src="{{asset('storage/'.$slide->image)}}" class="girl img-responsive" alt="" />
									<img src="images/home/pricing.png"  class="pricing" alt="" />
								</div>
								@endforeach

								@foreach($categories as $category)
                                               {{$category->name}}
											@endforeach
							
							@foreach($categories as $category)
											 @if($category->parent_id == 0)
											<li><a href="#">{{$category->name}} </a></li>
											@endif
											@endforeach
												a href="{{ url('product/'.$childs->id)}}">
											<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										@foreach($categories as $category)
										<a data-toggle="collapse" data-parent="#accordian" href="{{$category->id}}">
                                            @if($category->parent_id == 0)
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$category->name}}
											@endif
										</a>
										@endforeach
									</h4>
								</div>
								<div id="{{$category->id}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
										@foreach($categories as $category)
										if($category->id == $category->parent_id)
										<li><a href="{{$category->id}}">{{$category->name}} </a></li>
										@endforeach
											
										</ul>
									</div>
								</div>
							</div>
			@foreach($products as $product)
                               {{$product->productname}}
							
							