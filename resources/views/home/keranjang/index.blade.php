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
                                    <tr>
                                        <td colspan="4" class="prod-column">
                                            <div class="column-box">
                                                <div class="remove-btn">
                                                    <i class="flaticon-close"></i>
                                                </div>
                                                <div class="prod-thumb">
                                                    <a href="#"><img src="assets/images/resource/shop/cart-3.jpg" alt=""></a>
                                                </div>
                                                <div class="prod-title">
                                                    Baby Backpacks
                                                </div>    
                                            </div>
                                        </td>
                                        <td class="price">$70.00</td>
                                        <td class="qty">
                                            <div class="item-quantity">
                                                <input class="quantity-spinner" type="text" value="1" name="quantity">
                                            </div>
                                        </td>
                                        <td class="sub-total">$70.00</td>
                                    </tr>
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
                <div class="cart-total">
                    <div class="row">
                        <div class="col-xl-5 col-lg-12 col-md-12 offset-xl-7 cart-column">
                            <div class="total-cart-box clearfix">
                                <h4>Keranjang Total</h4>
                                <ul class="list clearfix">
                                    <li>Order Total:<span>$150</span></li>
                                </ul>
                                <a href="cart.html" class="theme-btn-two">Proceed to Checkout<i class="flaticon-right-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cart section end -->
    <!-- cart section end -->
@endsection