<!-- main header -->
<header class="main-header">
    <div class="header-top">
        <div class="auto-container">
            <div class="top-inner clearfix">
                <div class="top-left pull-left">
                    <ul class="info clearfix">
                        <li><i class="flaticon-email"></i><a href="mailto:support@example.com">support@example.com</a></li>
                        <li><i class="flaticon-global"></i> Kleine Pierbard 8-6 2249 KV Vries</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-lower">
        <div class="auto-container">
            <div class="outer-box">
                <figure class="logo-box"><a href="index.html"><img src="home/assets/images/loo.png" alt=""></a></figure>
                <div class="menu-area">
                    <!--Mobile Navigation Toggler-->
                    {{-- <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div> --}}
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix ml-auto" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="dropdown"><a href="index.html">{{ Auth::user()->name }}</a>
                                    <ul>
                                        <li><a href="{{ route('logout') }}">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                {{-- <ul class="menu-right-content clearfix">
                    <li>
                        <div class="search-btn">
                            <button type="button" class="search-toggler"><i class="flaticon-search"></i></button>
                        </div>
                    </li>
                    <li><a href="index.html"><i class="flaticon-user"></i></a></li>
                    <li class="shop-cart">
                        <a href="{{ route('keranjang') }}"><i class="flaticon-shopping-cart-1"></i><span>3</span></a>
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->
