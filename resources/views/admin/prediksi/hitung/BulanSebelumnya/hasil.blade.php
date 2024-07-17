@extends('admin.index')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Prediksi yang Dipilih</h1>
        </div>

        @foreach ($groupedData as $id_produk => $dataGroup)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prediksi Penjualan Bulan Depan {{ $dataGroup[0]->nama }} </h5>
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Bulan</th>
                                    <th>Kategori</th>
                                    <th>Qty</th>
                                    <th class="hidden">Periode</th>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
