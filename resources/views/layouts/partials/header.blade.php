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
                            <li><i class="ti-headphone-alt"></i> +62 (99) 99</li>
                            <li><i class="ti-email"></i> support@persariraharja.org</li>
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

    <!-- Header Inner -->
    <div class="header-inner text-white" style="background: rgb(166, 77, 121);">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">

                    <div class="col-lg-8 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
											<li style="display: flex;flex-direction: row;align-items: center;"><img src="{{asset('bazar/images/logo.svg')}}" alt="logo" width="45px"></li>
                                            <li class="{{ request()->is('/') ? 'active' : '' }} "><a href="/">Home</a></li>
                                            <li class="{{ request()->is('product') ? 'active' : '' }} "><a href="/product">Produk</a></li>
                                            <li class="{{ request()->is('information') ? 'active' : '' }} "><a href="/information">Informasi</a></li>
                                            <!-- <li><a href="/contact">Kontak Kami</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="right-bar">
                            <div class="sinlge-bar shopping">
                                @if(auth()->check())
                                @if(auth()->user()->hasRole('admin'))
                                <a href="dashboard" class="text-white single-icon"><small>Admin</small><i class="ml-2 ti-user"></i> </a>
                                <span class="mx-2">|</span>                                
                                @elseif(auth()->user()->hasRole('owner'))
                                <a href="orders" class="text-white single-icon"><small>Kelola</small><i class="ml-2 ti-settings"></i> </a>
                                <span class="mx-2">|</span>
                                @endif
                                @endif

                                @if(!auth()->check())
                                <a title="Login" href="/login" class="text-white single-icon"><small>Keranjangku</small><i class="ml-2 ti-bag"></i> <span class="total-count">1</span></a>
                                @else
                                <a href="history" class="text-white single-icon"><small>Riwayat</small><i class="ml-2 ti-save-alt"></i> </a>
                                <span class="mx-2">|</span>
                                <a href="cart" class="text-white single-icon"><small>Keranjangku</small><i class="ml-2 ti-bag"></i> <span class="total-count bg-primary">{{\App\Models\Order::where(['customer_id' => auth()->user()->id, 'in_cart' => 1])->count()}}</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->
