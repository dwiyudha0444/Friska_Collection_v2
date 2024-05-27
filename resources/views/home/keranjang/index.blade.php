@extends('home.index')
@section('content')
    <!-- cart section -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <!-- cart section -->
    <section class="cart-section cart-page">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 table-column">
                    <div class="table-outer">
                        <table class="cart-table">
                            <thead class="cart-header">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th class="prod-column">Name</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th class="price">Harga</th>
                                    <th class="quantity">Jumlah</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keranjang as $ker)
                                    <tr>
                                        <td colspan="4" class="prod-column">
                                            <div class="column-box">
                                                <div class="remove-btn">
                                                    <form action="{{ route('hapus-item') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $ker->id }}">
                                                    <button type="submit"><i class="flaticon-close"></i></button>
                                                </form>
                                                </div>
                                                <div class="prod-thumb">
                                                    <a href="#"><img src="assets/images/resource/shop/cart-3.jpg"
                                                            alt=""></a>
                                                </div>
                                                <div class="prod-title">
                                                    {{ $ker->nama }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price">{{ $ker->harga }}</td>
                                        <td class="qty">
                                            <div class="item-quantity">
                                                <input class="quantity-spinner" type="text" value="{{ $ker->qty }}"
                                                    name="quantity">
                                            </div>
                                        </td>
                                        <td class="sub-total">{{ $ker->harga * $ker->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="othre-content clearfix">

                <div class="update-btn pull-right">
                    <button type="submit" class="theme-btn-one">Update Keranjang<i class="flaticon-right-1"></i></button>
                </div>
            </div>
            <?php
            // Hitung total harga order dari keranjang belanja
            $orderTotal = 0;
            foreach ($keranjang as $ker) {
                $orderTotal += $ker->harga * $ker->qty;
            }
            ?>
            <div class="cart-total">
                <div class="row">
                    <div class="col-xl-5 col-lg-12 col-md-12 offset-xl-7 cart-column">
                        <div class="total-cart-box clearfix">
                            <h4>Keranjang Total</h4>
                            <ul class="list clearfix">
                                <li>Order Total:<span>{{ $orderTotal }}</span></li>
                            </ul>
                            <a href="cart.html" class="theme-btn-two">Proceed to Checkout<i
                                    class="flaticon-right-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart section end -->
    <!-- cart section end -->
@endsection
