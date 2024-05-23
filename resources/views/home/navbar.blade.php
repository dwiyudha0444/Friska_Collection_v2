        <!-- main header -->
        <header class="main-header">
            <div class="header-top">
                <div class="auto-container">
                    <div class="top-inner clearfix">
                        <div class="top-left pull-left">
                            <ul class="info clearfix">
                                <li><i class="flaticon-email"></i><a
                                        href="mailto:support@example.com">support@example.com</a></li>
                                <li><i class="flaticon-global"></i> Kleine Pierbard 8-6 2249 KV Vries</li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="header-lower">
                <div class="auto-container">
                    <div class="outer-box">
                        <figure class="logo-box"><a href="index.html"><img src="home/assets/images/logo.png"
                                    alt=""></a></figure>
                        <div class="menu-area">
                            <!--Mobile Navigation Toggler-->
                            <div class="mobile-nav-toggler">
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                                <i class="icon-bar"></i>
                            </div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class="current"><a href="{{ route('landingpage') }}">Home</a>
                                            
                                        </li>
                                        {{-- <li class="dropdown"><a href="index.html">Pages</a>
                                            <ul>
                                                <li><a href="about.html">About Us</a></li>
                                                <li><a href="service.html">Our Service</a></li>
                                                <li><a href="team.html">Our Team</a></li>
                                                <li><a href="testimonials.html">Testimonials</a></li>
                                                <li><a href="error.html">404</a></li>
                                            </ul>
                                        </li> --}}
                                        
                                        
                                        <li class="dropdown"><a href="index.html">Product</a>
                                            <ul>
                                                <li><a href="fashion">Fashion</a></li>
                                                <li><a href="prabotan">Prabotan</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown"><a href="index.html">{{ Auth::user()->name }}</a>
                                            <ul>
                                                <li><a href="{{ route('logout') }}">logout</a></li>
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <ul class="menu-right-content clearfix">
                            <li>
                                <div class="search-btn">
                                    <button type="button" class="search-toggler"><i
                                            class="flaticon-search"></i></button>
                                </div>
                            </li>
                            <li><a href="index.html"><i class="flaticon-user"></i></a></li>
                            <li class="shop-cart">
                                <a href="{{ route('keranjang') }}"><i class="flaticon-shopping-cart-1"></i><span>3</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="outer-box clearfix">
                        <div class="logo-box pull-left">
                            <figure class="logo"><a href="index.html"><img src="home/assets/images/small-logo.png"
                                        alt=""></a></figure>
                        </div>
                        <div class="menu-area pull-right">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->