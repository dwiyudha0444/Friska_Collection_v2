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

                    @foreach ($produk as $pro)
                        <div
                            class="col-lg-3 col-md-6 col-sm-12 shop-block masonry-item small-column best_seller new_arraivals">
                            <div class="shop-block-one">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        <img src="{{ url('admin/assets/image') }}/{{ $pro->image }}" alt="">
                                        <ul class="info-list clearfix">
                                            <li>
                                                {{-- <form action="{{ route('add-to-keranjang') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="nama" value="{{ $pro->nama }}">
                                                    <input type="hidden" name="id_kategori"
                                                        value="{{ $pro->id_kategori }}">
                                                    <input type="hidden" name="harga" value="{{ $pro->harga }}">
                                                    <input type="hidden" name="image" value="{{ $pro->image }}">
                                                    <input type="hidden" name="qty" value=1>
                                                    <button type="submit" class="styled-button"><i
                                                            class="flaticon-cart"></i></button>
                                                </form> --}}

                                                <form action="{{ route('add-to-keranjang') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="nama" value="{{ $pro->nama }}">
                                                    <input type="hidden" name="id_kategori"
                                                        value="{{ $pro->id_kategori }}">
                                                    <input type="hidden" name="harga" value="{{ $pro->harga }}">
                                                    <input type="hidden" name="image" value="{{ $pro->image }}">
                                                    <input type="hidden" name="qty" value="1">
                                                    @php
                                                        $inCart = false;
                                                        foreach ($cartItems as $item) {
                                                            if ($item->nama == $pro->nama) {
                                                                // Sesuaikan dengan atribut yang sesuai di model Cart
                                                                $inCart = true;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    @if ($inCart)
                                                        <button type="button" class="styled-button-red" disabled>Sudah ada di
                                                            Keranjang</button>
                                                    @else
                                                        <button type="submit" class="styled-button"><i
                                                                class="flaticon-cart"></i> Tambahkan ke Keranjang</button>
                                                    @endif
                                                </form>

                                            </li>
                                        </ul>
                                    </figure>
                                    <div class="lower-content">
                                        <a href="product-details.html">{{ $pro->nama }}</a>
                                        <a href="product-details.html">({{ $pro->id_kategori }})</a>
                                        <span class="price">{{ $pro->harga }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </div>

        <div class="more-btn centred"><a href="shop.html" class="theme-btn-one">View All Products<i
                    class="flaticon-right-1"></i></a></div>
        </div>
    </section>
    <!-- shop-section end -->
@endsection
