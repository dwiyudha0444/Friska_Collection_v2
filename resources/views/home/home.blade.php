@extends('home.index')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- shop-section -->
    <section class="shop-section">
        <div class="auto-container">
            <div class="sec-title">
                <h2>Our Top Collection</h2>
                <p>There are some product that we featured for choose your best</p>
                <span class="separator" style="background-image: url(assets/images/icons/separator-1.png);"></span>
            </div>
            <div class="sortable-masonry">

                <div class="row">
                    
                        <div
                            class="col-lg-3 col-md-6 col-sm-12 shop-block masonry-item small-column best_seller new_arraivals">
                            <div class="shop-block-one">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="home/assets/images/resource/shop/shop-8.jpg" alt="">
                                        <ul class="info-list clearfix">
                                            <li>
                                                <form action="/add-to-cart" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id_fashion" value="">
                                                    <input type="hidden" name="nama" value="">
                                                    <input type="hidden" name="kategori" value="">
                                                    <input type="hidden" name="harga" value="">
                                                    <button type="submit"><i class="flaticon-cart"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </figure>
                                    <div class="lower-content">
                                        <a href="product-details.html"></a>
                                        <a href="product-details.html"></a>
                                        <span class="price"></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>

            </div>
        </div>

        <div class="more-btn centred"><a href="shop.html" class="theme-btn-one">View All Products<i
                    class="flaticon-right-1"></i></a></div>
        </div>
    </section>
    <!-- shop-section end -->
@endsection
