@extends('admin.index')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Prediksi yang Dipilih</h1>
        </div>

        <!-- Tabel untuk Data Periode Sekarang -->
        @foreach ($selectedData as $id_produk => $dataGroup)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prediksi Penjualan Bulan Depan {{ $dataGroup[0]->nama }} </h5>
                        <table class="table">
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

        <!-- Tabel untuk Data Bulan-Bulan Sebelumnya -->
        @foreach ($previousMonthsData as $id_produk => $previousMonthGroup)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prediksi Penjualan Bulan Sebelumnya {{ $previousMonthGroup[0]->nama }} </h5>
                        <table class="table">
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
                                @foreach ($previousMonthGroup as $index => $data)
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
