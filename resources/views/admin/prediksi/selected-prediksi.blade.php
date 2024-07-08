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
                        <h5 class="card-title">Data Prediksi untuk Produk ID: {{ $id_produk }}</h5>
                        <div class="row mb-3">
                            <label for="filter-periode-{{ $id_produk }}" class="col-sm-2 col-form-label">Filter Periode:</label>
                            <div class="col-sm-10">
                                <select id="filter-periode-{{ $id_produk }}" class="form-select filter-periode" data-produk="{{ $id_produk }}">
                                    <option value="all">Semua</option>
                                    <option value="3">Periode 3</option>
                                    <option value="4">Periode 4</option>
                                </select>
                            </div>
                        </div>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Bulan</th>
                                    <th>Kategori</th>
                                    <th>Periode</th>
                                    <th>MA</th>
                                    <th>MAD</th>
                                    <th>MSE</th>
                                    <th>MAPE</th>
                                </tr>
                            </thead>
                            <tbody class="prediksi-table-body" data-produk="{{ $id_produk }}">
                                @foreach ($dataGroup as $index => $data)
                                    <tr data-periode="{{ $data->id_periode }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->created_at->format('F') }}</td>
                                        <td>{{ $data->kategori->nama }}</td>
                                        <td>{{ $data->id_periode }}</td>
                                        <td>{{ $data->ma }}</td>
                                        <td>{{ $data->mad }}</td>
                                        <td>{{ $data->mse }}</td>
                                        <td>{{ $data->mape }} %</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>Total MAD: <span class="total-mad" data-produk="{{ $id_produk }}"></span></div>
                        <div>Total MSE: <span class="total-mse" data-produk="{{ $id_produk }}"></span></div>
                        <div>Total MAPE: <span class="total-mape" data-produk="{{ $id_produk }}"></span></div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotals(produkId) {
            const rows = document.querySelectorAll(`.prediksi-table-body[data-produk='${produkId}'] tr`);
            let totalMAD = 0;
            let totalMSE = 0;
            let totalMAPE = 0;
            let count = 0;

            rows.forEach(row => {
                if (row.style.display !== 'none') {
                    totalMAD += parseFloat(row.children[6].textContent) || 0;
                    totalMSE += parseFloat(row.children[7].textContent) || 0;
                    totalMAPE += parseFloat(row.children[8].textContent) || 0;
                    count++;
                }
            });

            document.querySelector(`.total-mad[data-produk='${produkId}']`).textContent = count > 0 ? (totalMAD / count).toFixed(2) : 0;
            document.querySelector(`.total-mse[data-produk='${produkId}']`).textContent = count > 0 ? (totalMSE / count).toFixed(2) : 0;
            document.querySelector(`.total-mape[data-produk='${produkId}']`).textContent = count > 0 ? (totalMAPE / count).toFixed(2) + ' %' : '0 %';
        }

        document.querySelectorAll('.filter-periode').forEach(select => {
            select.addEventListener('change', function(event) {
                const periode = event.target.value;
                const produkId = event.target.getAttribute('data-produk');
                const rows = document.querySelectorAll(`.prediksi-table-body[data-produk='${produkId}'] tr`);
                rows.forEach(row => {
                    if (periode === 'all' || row.getAttribute('data-periode') === periode) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                calculateTotals(produkId);
            });
        });

        // Hitung total untuk setiap produk saat halaman dimuat
        document.querySelectorAll('.filter-periode').forEach(select => {
            calculateTotals(select.getAttribute('data-produk'));
        });
    });
</script>
