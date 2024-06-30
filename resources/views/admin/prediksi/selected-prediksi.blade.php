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
                                    <td>{{ $data->mape }} %</td>
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
                    <h5 class="card-title">Data Total Mean Absolute Deviation (MAD) Periode 3</h5>

                    <table class="table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                @foreach ($selectedDataFirst as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody>
                            <tr>
                                <td>{{ $no++ }}</td>
                                @foreach ($madValues as $item)
                                    <td>{{ htmlspecialchars($item) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>


                    {{-- {{$madValues = htmlspecialchars($data['name']);}} --}}
                    {{-- {{ $madValue }} --}}
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Total Mean Absolute Deviation (MAD) Periode 4</h5>

                    <table class="table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                @foreach ($selectedDataFirst as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody>
                            <tr>
                                <td>{{ $no++ }}</td>
                                @foreach ($madValuesPeriodeEmpat as $item)
                                    <td>{{ htmlspecialchars($item) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>


                    {{-- {{$madValues = htmlspecialchars($data['name']);}} --}}
                    {{-- {{ $madValue }} --}}
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Total Mean Squared Error (MSE) Periode 3</h5>

                    <table class="table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                @foreach ($selectedDataFirst as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody>
                            <tr>
                                <td>{{ $no++ }}</td>
                                @foreach ($mseValues as $item)
                                    <td>{{ htmlspecialchars($item) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Total Mean Squared Error (MSE) Periode 4</h5>

                    <table class="table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                @foreach ($selectedDataFirst as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody>
                            <tr>
                                <td>{{ $no++ }}</td>
                                @foreach ($mseValuesPeriodeEmpat as $item)
                                    <td>{{ htmlspecialchars($item) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Total Mean Absolute Percentage Error (MAPE) Periode 3</h5>

                    <table class="table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                @foreach ($selectedDataFirst as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody>
                            <tr>
                                <td>{{ $no++ }}</td>
                                @foreach ($mapeValues as $item)
                                    <td>{{ htmlspecialchars($item) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Total Mean Absolute Percentage Error (MAPE) Periode 4</h5>

                    <table class="table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                @foreach ($selectedDataFirst as $item)
                                    <th>{{ $item->nama }}</th>
                                @endforeach

                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody>
                            <tr>
                                <td>{{ $no++ }}</td>
                                @foreach ($mapeValuesPeriodeEmpat as $item)
                                    <td>{{ htmlspecialchars($item) }} %</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
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
