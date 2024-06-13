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
                        <h2>Searchable Table</h2>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for names..">

                        <table id="dataTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>30</td>
                                    <td>USA</td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>25</td>
                                    <td>Canada</td>
                                </tr>
                                <tr>
                                    <td>William Johnson</td>
                                    <td>40</td>
                                    <td>UK</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                        <form id="update-keranjang-form" action="{{ route('update-keranjang') }}" method="post">
                            @csrf
                            <table class="cart-table">
                                <thead class="cart-header">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th class="prod-column">Nama</th>
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
                                                            <input type="hidden" name="cart_id"
                                                                value="{{ $ker->id }}">
                                                            <button type="submit"><i class="flaticon-close"></i></button>
                                                        </form>
                                                    </div>
                                                    <div class="prod-thumb">
                                                        <a href="#"><img src="assets/images/resource/shop/cart-3.jpg"
                                                                alt=""></a>
                                                    </div>
                                                    <div class="prod-title">{{ $ker->nama }}</div>
                                                </div>
                                            </td>
                                            <td class="price">{{ $ker->harga }}</td>
                                            <td class="qty">
                                                <div class="item-quantity">
                                                    <input class="quantity-spinner" type="number"
                                                        value="{{ $ker->qty }}" name="quantity[]"
                                                        data-id="{{ $ker->id }}">
                                                    <input type="hidden" name="cart_id[]" value="{{ $ker->id }}">
                                                </div>
                                            </td>
                                            <td class="sub-total">{{ $ker->harga * $ker->qty }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('.quantity-spinner').on('change', function() {
                                    var qty = $(this).val();
                                    var cartId = $(this).data('id');

                                    console.log("Mengirim permintaan AJAX dengan qty:", qty, "dan cartId:", cartId);

                                    $.ajax({
                                        url: "{{ route('update-keranjang') }}",
                                        method: "POST",
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                            cart_id: cartId,
                                            quantity: qty
                                        },
                                        success: function(response) {
                                            console.log("Pembaruan berhasil:", response);
                                            location
                                                .reload(); // Muat ulang halaman untuk memperbarui subtotal dan total
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Pembaruan gagal:", xhr.responseText);
                                            console.error("Status:", status);
                                            console.error("Error:", error);
                                            alert('Terjadi kesalahan saat memperbarui keranjang.');
                                        }
                                    });
                                });
                            });
                        </script>
                        <script>
                            /* script.js */
                            function searchTable() {
                                var input, filter, table, tr, td, i, j, txtValue;
                                input = document.getElementById("searchInput");
                                filter = input.value.toLowerCase();
                                table = document.getElementById("dataTable");
                                tr = table.getElementsByTagName("tr");

                                for (i = 1; i < tr.length; i++) { // Skip the header row
                                    tr[i].style.display = "none"; // Hide the row initially
                                    td = tr[i].getElementsByTagName("td");
                                    for (j = 0; j < td.length; j++) {
                                        if (td[j]) {
                                            txtValue = td[j].textContent || td[j].innerText;
                                            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                                                tr[i].style.display = "";
                                                break; // If a match is found, show the row and exit the loop
                                            }
                                        }
                                    }
                                }
                            }
                        </script>


                    </div>
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
                            <form action="{{ route('checkout2') }}" method="POST">
                                @csrf
                                @foreach ($keranjang as $ca)
                                    <input type="hidden" name="items[{{ $loop->index }}][id_produk]"
                                        value="{{ $ca->id_produk }}">
                                    <input type="hidden" name="items[{{ $loop->index }}][nama]"
                                        value="{{ $ca->nama }}">
                                    <input type="hidden" name="items[{{ $loop->index }}][id_kategori]"
                                        value="{{ $ca->id_kategori }}">
                                    <input type="hidden" name="items[{{ $loop->index }}][image]"
                                        value="{{ $ca->image }}">
                                    <input type="hidden" name="items[{{ $loop->index }}][harga]"
                                        value="{{ $ca->harga }}">
                                    <input type="hidden" name="items[{{ $loop->index }}][qty]"
                                        value="{{ $ca->qty }}">
                                @endforeach
                                <button type="submit" class="theme-btn-two">Checkout<i
                                        class="flaticon-right-1"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cart section end -->
    <!-- cart section end -->
@endsection
