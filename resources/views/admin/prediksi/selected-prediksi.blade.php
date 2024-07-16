@extends('admin.index')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Prediksi yang Dipilih</h1>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Prediksi Penjualan Bulan Depan</h5>

                </div>
            </div>
        </div>

        @foreach ($groupedData as $id_produk => $dataGroup)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Data Prediksi untuk Produk ID: {{ $dataGroup[0]->nama }}</h5>

                        <style>
                            .hidden {
                                display: none;
                            }
                        </style>

                        <div class="row mb-3 hidden">
                            <label for="filter-periode-{{ $id_produk }}" class="col-sm-2 col-form-label">Filter
                                Periode:</label>
                            <div class="col-sm-10">
                                <select id="filter-periode-{{ $id_produk }}" class="form-select filter-periode"
                                    data-produk="{{ $id_produk }}">
                                    <option value="all">Semua</option>
                                    <option value="3">Periode 3</option>
                                    <option value="4">Periode 4</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="start-date-{{ $id_produk }}" class="col-sm-2 col-form-label">Dari Bulan:</label>
                            <div class="col-sm-4">
                                <input type="month" id="start-date-{{ $id_produk }}" class="form-control start-date"
                                    data-produk="{{ $id_produk }}">
                            </div>
                            <label for="end-date-{{ $id_produk }}" class="col-sm-2 col-form-label">Sampai Bulan:</label>
                            <div class="col-sm-4">
                                <input type="month" id="end-date-{{ $id_produk }}" class="form-control end-date"
                                    data-produk="{{ $id_produk }}">
                            </div>
                        </div>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Bulan</th>
                                    <th>Kategori</th>
                                    <th>Qty</th>
                                    <th class="hidden">Periode</th>
                                    <th>MA</th>
                                    <th>MAD</th>
                                    <th>MSE</th>
                                    <th>MAPE</th>
                                </tr>
                            </thead>
                            <tbody class="prediksi-table-body" data-produk="{{ $id_produk }}">
                                @foreach ($dataGroup as $index => $data)
                                    <tr data-periode="{{ $data->id_periode }}"
                                        data-bulan="{{ $data->created_at->format('Y-m') }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->created_at->format('F Y') }}</td>
                                        <td>{{ $data->kategori->nama }}</td>
                                        <td>{{ $data->id_filter }}</td>
                                        <td class="hidden">{{ $data->id_periode }}</td>
                                        <td>{{ $data->ma }}</td>
                                        <td>{{ $data->mad }}</td>
                                        <td>{{ $data->mse }}</td>
                                        <td>{{ $data->mape }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Total and Average Cards -->
                        <div class="row">

                            <!-- Left side columns -->
                            <div class="col-lg-12">
                                <div class="row">

                                    <!-- Sales Card -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div class="card info-card sales-card">


                                            <div class="card-body">
                                                <h5 class="card-title">Total MAD</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h4><span class="total-mad"
                                                                data-produk="{{ $id_produk }}"></span></h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- End Sales Card -->

                                    <!-- Revenue Card -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div class="card info-card revenue-card">

                                            <div class="card-body">
                                                <h5 class="card-title">Total MSE</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h4><span class="total-mse"
                                                                data-produk="{{ $id_produk }}"></span></h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- End Revenue Card -->

                                    <!-- Sales Card -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div class="card info-card sales-card">


                                            <div class="card-body">
                                                <h5 class="card-title">Total MAPE</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h4><span class="total-mape"
                                                                data-produk="{{ $id_produk }}"></span></h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- End Sales Card -->

                                    <!-- Revenue Card -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div class="card info-card revenue-card">

                                            <div class="card-body">
                                                <h5 class="card-title">Rata-Rata MAD</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h4><span class="avg-mad" data-produk="{{ $id_produk }}"></span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- End Revenue Card -->

                                    <!-- Sales Card -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div class="card info-card sales-card">


                                            <div class="card-body">
                                                <h5 class="card-title">Rata-Rata MSE</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h4><span class="avg-mse" data-produk="{{ $id_produk }}"></span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- End Sales Card -->

                                    <!-- Revenue Card -->
                                    <div class="col-xxl-4 col-md-6">
                                        <div class="card info-card revenue-card">

                                            <div class="card-body">
                                                <h5 class="card-title">Rata-Rata MAPE</span></h5>

                                                <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h4><span class="avg-mape"
                                                                data-produk="{{ $id_produk }}"></span></h4>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- End Revenue Card -->

                                    <div class="col-xxl-12 col-xl-12">
                                        <div class="card info-card customers-card">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Total Item</h5>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="ps-3">
                                                        <h4><span class="total-item"
                                                                data-produk="{{ $id_produk }}"></span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div><!-- End Left side columns -->

                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <canvas id="chart-{{ $id_produk }}"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menggambar grafik berdasarkan data yang ditampilkan di tabel
        function drawChart(produkId) {
            const ctx = document.getElementById(`chart-${produkId}`).getContext('2d');
            const rows = document.querySelectorAll(`.prediksi-table-body[data-produk='${produkId}'] tr`);

            const labels = [];
            const qtyData = [];
            const maData = [];

            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    const bulan = row.children[2].textContent;
                    const qty = parseFloat(row.children[4].textContent) || 0;
                    const ma = parseFloat(row.children[6].textContent) || 0;

                    labels.push(bulan);
                    qtyData.push(qty);
                    maData.push(ma);
                }
            });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Qty',
                            data: qtyData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 4,
                        },
                        {
                            label: 'MA',
                            data: maData,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderWidth: 4,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });
        }

        document.querySelectorAll('.filter-periode').forEach(select => {
            select.addEventListener('change', function(event) {
                const produkId = event.target.getAttribute('data-produk');
                const periode = event.target.value;
                const rows = document.querySelectorAll(
                    `.prediksi-table-body[data-produk='${produkId}'] tr`);
                rows.forEach(row => {
                    if (periode === 'all' || row.getAttribute('data-periode') ===
                        periode) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                calculateTotals(produkId);
                drawChart(produkId); // Menggambar ulang grafik setelah perubahan filter
            });
        });

        document.querySelectorAll('.start-date, .end-date').forEach(input => {
            input.addEventListener('change', function(event) {
                const produkId = event.target.getAttribute('data-produk');
                filterByDateRange(produkId);
                drawChart(produkId); // Menggambar ulang grafik setelah perubahan filter
            });
        });

        // Gambar grafik untuk setiap produk ketika halaman dimuat
        document.querySelectorAll('.filter-periode').forEach(select => {
            drawChart(select.getAttribute('data-produk'));
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotals(produkId) {
            const rows = document.querySelectorAll(`.prediksi-table-body[data-produk='${produkId}'] tr`);
            let totalMAD = 0;
            let totalMSE = 0;
            let totalMAPE = 0;
            let totalItem = 0;

            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    totalMAD += parseFloat(row.children[7].textContent) || 0;
                    totalMSE += parseFloat(row.children[8].textContent) || 0;
                    totalMAPE += parseFloat(row.children[9].textContent) || 0;
                    totalItem++;
                }
            });

            const avgMAD = totalItem > 0 ? (totalMAD / totalItem).toFixed(2) : 0;
            const avgMSE = totalItem > 0 ? (totalMSE / totalItem).toFixed(2) : 0;
            const avgMAPE = totalItem > 0 ? (totalMAPE / totalItem).toFixed(2) : 0;

            document.querySelector(`.total-mad[data-produk='${produkId}']`).textContent = totalMAD.toFixed(2);
            document.querySelector(`.total-mse[data-produk='${produkId}']`).textContent = totalMSE.toFixed(2);
            document.querySelector(`.total-mape[data-produk='${produkId}']`).textContent = totalMAPE.toFixed(2);
            document.querySelector(`.total-item[data-produk='${produkId}']`).textContent = totalItem;

            document.querySelector(`.avg-mad[data-produk='${produkId}']`).textContent = avgMAD;
            document.querySelector(`.avg-mse[data-produk='${produkId}']`).textContent = avgMSE;
            document.querySelector(`.avg-mape[data-produk='${produkId}']`).textContent = avgMAPE;
        }

        function filterByDateRange(produkId) {
            const startDate = document.querySelector(`#start-date-${produkId}`).value;
            const endDate = document.querySelector(`#end-date-${produkId}`).value;
            const rows = document.querySelectorAll(`.prediksi-table-body[data-produk='${produkId}'] tr`);

            rows.forEach(row => {
                const rowDate = row.getAttribute('data-bulan');
                if ((!startDate || rowDate >= startDate) && (!endDate || rowDate <= endDate)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            calculateTotals(produkId);
        }

        document.querySelectorAll('.filter-periode').forEach(select => {
            select.addEventListener('change', function(event) {
                const periode = event.target.value;
                const produkId = event.target.getAttribute('data-produk');
                const rows = document.querySelectorAll(
                    `.prediksi-table-body[data-produk='${produkId}'] tr`);
                rows.forEach(row => {
                    if (periode === 'all' || row.getAttribute('data-periode') ===
                        periode) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                calculateTotals(produkId);
            });
        });

        document.querySelectorAll('.start-date, .end-date').forEach(input => {
            input.addEventListener('change', function(event) {
                const produkId = event.target.getAttribute('data-produk');
                filterByDateRange(produkId);
            });
        });

        // Calculate totals for each product when the page loads
        document.querySelectorAll('.filter-periode').forEach(select => {
            calculateTotals(select.getAttribute('data-produk'));
        });
    });
</script>
