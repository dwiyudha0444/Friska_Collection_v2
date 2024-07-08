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
                    <div>Total MAD: <span id="total-mad"></span></div>
                    <div>Total MSE: <span id="total-mse"></span></div>
                    <div>Total MAPE: <span id="total-mape"></span></div>
                </div>
            </div>
        </div>
    </main>

    {{-- <table class="table ">
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
    </div> --}}
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateTotals() {
            const rows = document.querySelectorAll('#prediksi-table-body tr');
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

            document.getElementById('total-mad').textContent = count > 0 ? (totalMAD / count).toFixed(2) : 0;
            document.getElementById('total-mse').textContent = count > 0 ? (totalMSE / count).toFixed(2) : 0;
            document.getElementById('total-mape').textContent = count > 0 ? (totalMAPE / count).toFixed(2) +
                ' %' : '0 %';
        }

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
            calculateTotals();
        });

        calculateTotals();
    });
</script>
