
<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								
								<li><a href="{{ url('auth/google') }}"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{route('home_shopper')}}"><img src="images/home/logo.png" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
                          
                                <li><a href="{{route('user.account')}}"><i class="fa fa-user"></i> Account</a></li>
                                
								<li><a href="{{url('/WishList')}}"><i class="fa fa-star"></i> Wishlist</a></li>
								
							<li><a href="{{route('cart')}}"><span class="badge">{{Cart::content()->count()}}</span><i class="fa fa-shopping-cart"></i>Cart </a></li>
								@guest
								<li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Login</a></li>
                             @else
              			  <li>
                             <!-- {{ Auth::user()->name }}
 -->
                  		   <a href="{{ route('logoutuser') }}" 
                  		     onclick="event.preventDefault();
                		      document.getElementById('logout-form').submit();">
                                            Logout</a>
                                       <form id="logout-form" action="{{ route('logoutuser') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                       </form>

                          </li>
             		      @endguest



							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{route('home_shopper')}}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{route('home_shopper')}}">Products</a></li>
										
										<li><a href="{{url('/checkout')}}">Checkout</a></li> 
										<li><a href="{{route('cart')}}">Cart</a></li> 
										<li> </li> 
                                    </ul>
                                </li> 
								<!-- <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>  -->
                            <li><a href="{{route('contactus')}}">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	