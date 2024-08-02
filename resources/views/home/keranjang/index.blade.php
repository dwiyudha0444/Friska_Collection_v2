@extends('home.index')
@section('content')
<div class="navbar">
    <!-- Isi navbar di sini -->
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<section class="cart-section cart-page">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 table-column">
                <div class="table-outer">
                    <h2>Tabel Pencarian</h2>
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari nama..">
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($produk as $pro)
                                <tr style="display: none;">
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td class="text-center">{{ $pro->nama }}</td>
                                    <td class="text-center">{{ $pro->kategori->nama }}</td>
                                    <td class="text-center">{{ $pro->harga }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('add-to-keranjang') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id_produk" value="{{ $pro->id }}">
                                            <input type="hidden" name="nama" value="{{ $pro->nama }}">
                                            <input type="hidden" name="id_kategori" value="{{ $pro->id_kategori }}">
                                            <input type="hidden" name="harga" value="{{ $pro->harga }}">
                                            <input type="hidden" name="image" value="{{ $pro->image }}">
                                            <input type="hidden" name="qty" value="1">
                                            @php
                                                $inCart = false;
                                                foreach ($keranjang as $item) {
                                                    if ($item->nama == $pro->nama) {
                                                        $inCart = true;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            @if ($inCart)
                                                <button type="button" class="styled-button-red" disabled><i class="fa fa-check"></i></button>
                                            @else
                                                <button type="submit" class="styled-button"><i class="flaticon-cart"></i></button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Tabel keranjang belanja dan konten lainnya -->
                    <table class="cart-table">
                        <thead class="cart-header">
                            <tr>
                                <th colspan="4" class="prod-column">Nama</th>
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
                                            <div class="prod-title">{{ $ker->nama }}</div>
                                        </div>
                                    </td>
                                    <td class="price">{{ $ker->harga }}</td>
                                    <td class="qty">
                                        <div class="item-quantity">
                                            <input class="quantity-spinner" type="number" value="{{ $ker->qty }}" name="quantity[]" data-id="{{ $ker->id }}">
                                            <input type="hidden" name="cart_id[]" value="{{ $ker->id }}">
                                        </div>
                                    </td>
                                    <td class="sub-total">{{ $ker->harga * $ker->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

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
                                        location.reload(); // Muat ulang halaman untuk memperbarui subtotal dan total
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

                        function searchTable() {
                            var input, filter, table, tr, td, i, j, txtValue;
                            input = document.getElementById("searchInput");
                            filter = input.value.toLowerCase();
                            table = document.getElementById("dataTable");
                            tr = table.getElementsByTagName("tr");

                            if (filter === "") {
                                // Jika input pencarian kosong, sembunyikan semua baris kecuali header
                                for (i = 1; i < tr.length; i++) {
                                    tr[i].style.display = "none";
                                }
                            } else {
                                // Jika ada query pencarian, filter baris tabel
                                for (i = 1; i < tr.length; i++) { // Lewati baris header
                                    tr[i].style.display = "none"; // Sembunyikan baris awalnya
                                    td = tr[i].getElementsByTagName("td");
                                    for (j = 0; j < td.length; j++) {
                                        if (td[j]) {
                                            txtValue = td[j].textContent || td[j].innerText;
                                            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                                                tr[i].style.display = "";
                                                break; // Jika ditemukan kecocokan, tampilkan baris dan keluar dari loop
                                            }
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
                                <input type="hidden" name="items[{{ $loop->index }}][id_produk]" value="{{ $ca->id_produk }}">
                                <input type="hidden" name="items[{{ $loop->index }}][nama]" value="{{ $ca->nama }}">
                                <input type="hidden" name="items[{{ $loop->index }}][id_kategori]" value="{{ $ca->id_kategori }}">
                                <input type="hidden" name="items[{{ $loop->index }}][image]" value="{{ $ca->image }}">
                                <input type="hidden" name="items[{{ $loop->index }}][harga]" value="{{ $ca->harga }}">
                                <input type="hidden" name="items[{{ $loop->index }}][qty]" value="{{ $ca->qty }}">
                            @endforeach
                            <button type="submit" class="theme-btn-two">Checkout<i class="flaticon-right-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
