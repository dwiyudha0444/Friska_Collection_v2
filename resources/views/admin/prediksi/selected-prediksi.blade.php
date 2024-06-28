@extends('admin.index')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Prediksi yang Dipilih</h1>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Prediksi yang Dipilih</h5>
                    <div class="row mb-3">
                        <label for="filter-periode" class="col-sm-2 col-form-label">Filter Periode:</label>
                        <div class="col-sm-10">
                            <select id="filter-periode" class="form-select">
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
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody id="prediksi-table-body">
                            @foreach ($selectedData as $index => $data)
                                <tr data-periode="{{ $data->id_periode }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->created_at->format('F') }}</td>
                                    <td>{{ $data->kategori->nama }}</td>
                                    <td>{{ $data->id_periode }}</td>
                                    <td>{{ $data->ma }}</td>
                                    <td>{{ $data->mad }}</td>
                                    <td>{{ $data->mse }}</td>
                                    <td>{{ $data->mape }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Prediksi yang Dipilih</h5>
                    
                </div>
            </div>
        </div>

    </main>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter berdasarkan id_periode
        document.getElementById('filter-periode').addEventListener('change', function(event) {
            const periode = event.target.value;
            const rows = document.querySelectorAll('#prediksi-table-body tr');
            rows.forEach(row => {
                if (periode === 'all' || row.getAttribute('data-periode') === periode) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
