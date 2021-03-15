<!-- Header -->
<header class="header shop">
	<!-- Topbar -->
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-12 col-12">
					<!-- Top Left -->
					<div class="top-left">
						<ul class="list-main">
							<li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
							<li><i class="ti-email"></i> support@shophub.com</li>
						</ul>
					</div>
					<!--/ End Top Left -->
				</div>
				<div class="col-lg-7 col-md-12 col-12">
					<!-- Top Right -->
					<div class="right-content">
						<ul class="list-main">
						@if(!auth()->check())
							<!-- <li><i class="ti-user"></i> <a href="#">My account</a></li> -->
							<li><i class="ti-power-off"></i><a href="/login">Login</a></li>
							<li><i class="ti-shift-right-alt"></i><a href="/register">Register</a></li>
						@else
							<li> Hai, {{auth()->user()->name}} </li>
							<li> 
								<form method="POST" action="{{ route('logout') }}">
									@csrf
									<i class="ti-shift-right"></i><button type="submit" class="single-icon bg-danger text-white p-1"> <small> Logout</small></a> 
								</form>
							</li>
						@endif
						</ul>
					</div>
					<!-- End Top Right -->
				</div>
			</div>
		</div>
	</div>
	<!-- End Topbar -->
	<div class="middle-inner">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-12">
					<!-- Logo -->
					<div class="logo">
						<a href="index.html"><img src="{{asset('bazar/images/logo.svg')}}" alt="logo" class="w-25"></a>
					</div>
					<!--/ End Logo -->
					<!-- Search Form -->
					<div class="search-top">
						<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
						<!-- Search Form -->
						<div class="search-top">
							<form class="search-form">
								<input type="text" placeholder="Search here..." name="search">
								<button value="search" type="submit"><i class="ti-search"></i></button>
							</form>
						</div>
						<!--/ End Search Form -->
					</div>
					<!--/ End Search Form -->
					<div class="mobile-nav"></div>
				</div>
				<div class="col-lg-8 col-md-7 col-12">
					<div class="search-bar-top">
						<div class="search-bar">
							<!-- <select>
								<option selected="selected">All Category</option>
								<option>watch</option>
								<option>mobile</option>
								<option>kid’s item</option>
							</select> -->
							<div>
								<input name="name" placeholder="Search Products Here....." type="search" id="searchText">
								<button type="button" id="btnSearch" class="btnn"><i class="ti-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-12">
					<div class="right-bar">
						<div class="sinlge-bar shopping">
							@if(!auth()->check())
							<a title="Login" href="/login" class="single-icon"><small>Keranjangku</small><i class="ml-2 ti-bag"></i> <span class="total-count">1</span></a>
							@else
							<a href="cart" class="single-icon"><small>Keranjangku</small><i class="ml-2 ti-bag"></i> <span class="total-count">{{\App\Models\Order::where(['customer_id' => auth()->user()->id, 'in_cart' => 1])->count()}}</span></a>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Header Inner -->
	<div class="header-inner text-white" style="background: rgb(166, 77, 121);">
		<div class="container">
			<div class="cat-nav-head">
				<div class="row">

					<div class="col-lg-9 col-12">
						<div class="menu-area">
							<!-- Main Menu -->
							<nav class="navbar navbar-expand-lg">
								<div class="navbar-collapse">
									<div class="nav-inner">
										<ul class="nav main-menu menu navbar-nav">
											<li class="active"><a href="#">Home</a></li>
											<li><a href="#">Product</a></li>
											<li><a href="#">Blog</a></li>
											<li><a href="contact.html">Contact Us</a></li>
										</ul>
									</div>
								</div>
							</nav>
							<!--/ End Main Menu -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Header Inner -->
</header>
<!--/ End Header -->