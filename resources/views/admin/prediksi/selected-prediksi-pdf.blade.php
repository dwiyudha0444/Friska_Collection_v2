<!DOCTYPE html>
<html>

<head>
    <title>Laporan Prediksi</title>
    <style>
        /* CSS untuk style PDF Anda */
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Prediksi</h1>
        <p>{{ date('d-m-Y') }}</p>
    </div>

     @foreach ($groupedData as $id_produk => $dataGroup)
            @php

                // Sort the dataGroup by created_at in descending order
                $sortedData = $dataGroup->sortByDesc('created_at');
                // Get the latest entry
                $latestData = $sortedData->first();

                // Determine which set of data to use based on id_periode
                if ($latestData->id_periode == 3) {
                    $nextEntries = $sortedData->slice(1, 3); // Use $nextThreeLatestData
                } elseif ($latestData->id_periode == 4) {
                    $nextEntries = $sortedData->slice(1, 4); // Use $nextThreeLatestData4
                } else {
                    // Default to showing four entries if id_periode is neither 3 nor 4
                    $nextEntries = $sortedData->slice(1, 4);
                }
            @endphp

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prediksi Penjualan Bulan Depan {{ $latestData->nama }} </h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Bulan</th>
                                    <th>Kategori</th>

                                </tr>
                            </thead>
                            <tbody class="prediksi-table-body">
                                <tr data-periode="{{ $latestData->id_periode }}"
                                    data-bulan="{{ $latestData->created_at->format('Y-m') }}">
                                    <td>1</td>
                                    <td>{{ $latestData->nama }}</td>
                                    <td>{{ $latestData->created_at->addMonth()->format('F Y') }}</td>
                                    <td>{{ $latestData->kategori->nama }}</td>
                                    <td class="hidden">{{ $latestData->id_filter }}</td>
                                    <td class="hidden">{{ $latestData->id_periode }}</td>
                                    <td class="hidden">{{ $latestData->ma }}</td>
                                    <td class="hidden">{{ $latestData->mad }}</td>
                                    <td class="hidden">{{ $latestData->mse }}</td>
                                    <td class="hidden">{{ $latestData->mape }}</td>
                                </tr>
                            </tbody>

                        </table>

                        <div class="row">

                            <!-- Left side columns -->
                            <div class="col-lg-12">
                                <div class="row">
                                    <!-- Hasil Prediksi (moving average) Card -->
                                    <div class="col-xxl-6 col-xl-6">
                                        <div class="card info-card customers-card">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Prediksi Penjualan</h5>
                                                <div class="row">
                                                    <div class="col-xxl-12 col-xl-12 mb-1">
                                                        <div class="card info-card revenue-card">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">MA (moving average)</h5>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div class="ps-3">
                                                                        <h4><span>{{ number_format($latestData->ma) }}</span>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Accuracy Cards -->
                                    <div class="col-xxl-6 col-xl-6 mb-1">
                                        <div class="card info-card revenue-card">
                                            <div class="card-body">
                                                <h5 class="card-title">Keakuratan Hasil Peramalan</h5>
                                                <div class="row">
                                                    <!-- MAD Card -->
                                                    <div class="col-xxl-4 col-xl-4 mb-1">
                                                        <div class="card info-card revenue-card">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">MAD</h5>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div class="ps-3">
                                                                        <h4><span>{{ $latestData->mad }}</span></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- MSE Card -->
                                                    <div class="col-xxl-4 col-xl-4 mb-1">
                                                        <div class="card info-card sales-card">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">MSE</h5>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div class="ps-3">
                                                                        <h4><span>{{ $latestData->mse }}</span></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- MAPE Card -->
                                                    <div class="col-xxl-4 col-xl-4 mb-1">
                                                        <div class="card info-card revenue-card">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">MAPE</h5>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div class="ps-3">
                                                                        <h4><span>{{ $latestData->mape }}</span></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xxl-6 col-xl-6 mb-1">
                                        <div class="card info-card customers-card">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Sisa Stok</h5>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="ps-3">
                                                        <h4><span>{{ $latestData->sisa_stok }}</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-xxl-3 col-xl-3 mb-1">
                                        <div class="card info-card customers-card">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Total Penjualan</h5>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="ps-3">
                                                        <h4><span>{{ $latestData->id_filter }}</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <!-- Selisih Stok dan Penjualan Card -->
                                    <div class="col-xxl-3 col-xl-3 mb-1">
                                        <div class="card info-card customers-card">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Selisih Stok dan Penjualan</h5>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="ps-3">
                                                        <h4><span>{{ abs($latestData->sisa_stok - $latestData->id_filter) }}</span></h4>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Selisih Stok dan Penjualan Card -->
                                    <div class="col-xxl-6 col-xl-6 mb-1">
                                        @if ($latestData->sisa_stok > $latestData->ma)
                                            <div class="card info-card customers-card"
                                                style="background-color: #28a745; color: #ffffff;">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title color">Rekomendasi Restok</h5>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="ps-3">
                                                            <h4><span>Stok Aman</span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="card info-card customers-card"
                                                style="background-color: #ff0000; color: #ffffff;">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title color">Rekomendasi Restok</h5>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="ps-3">
                                                            <h4><span>{{ number_format(abs($latestData->ma - $latestData->sisa_stok)) }}</span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-xxl-12 col-xl-12">
                                        <div class="card info-card customers-card">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Catatan</h5>
                                                <div class="row">
                                                    <div class="col-xxl-6 col-xl-6 mb-1">
                                                        <div class="card info-card revenue-card">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">Mape</h5>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div class="ps-3 text-start">
                                                                        <p>• Jika nilai MAPE kurang dari 10%, maka kemampuan
                                                                            model peramalan sangat baik.</p>
                                                                        <p>• Jika nilai MAPE antara 10% - 20%, maka
                                                                            kemampuan model peramalan baik.</p>
                                                                        <p>• Jika nilai MAPE kisaran 20% - 50%, maka
                                                                            kemampuan model peramalan layak.</p>
                                                                        <p>• Jika nilai MAPE kisaran lebih dari 50%, maka
                                                                            kemampuan model peramalan buruk.</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6 col-xl-6 mb-1">
                                                        <div class="card info-card revenue-card">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">MSE dan MAD</h5>
                                                                <div
                                                                    class="d-flex align-items-center justify-content-center">
                                                                    <div class="ps-3 text-start">
                                                                        <p>• MSE (Mean Squared Error): Mengukur rata-rata
                                                                            kuadrat selisih antara nilai prediksi dan nilai
                                                                            aktual. Semakin kecil MSE, semakin dekat
                                                                            prediksi model dengan nilai aktual.</p>

                                                                        <p>• MAD Mean Absolute Deviation Mengukur rata-rata
                                                                            selisih absolut antara nilai prediksi dan nilai
                                                                            aktual. Nilai MAD yang kecil menunjukkan bahwa
                                                                            prediksi model lebih mendekati nilai aktual.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Left side columns -->

                        </div>

                        <h5 class="card-title mt-4">{{ count($nextEntries) }} Data Periode</h5>
                        <table class="table">
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
                            <tbody class="prediksi-table-body">
                                @foreach ($nextEntries as $index => $data)
                                    <tr data-periode="{{ $data->id_periode }}"
                                        data-bulan="{{ $data->created_at->format('Y-m') }}">
                                        <td>{{ $index + 1 }}</td> <!-- Adjusting index to start from 2 -->
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->created_at->addMonth()->format('F Y') }}</td>
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

                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Data Prediksi untuk Produk: {{ $dataGroup[0]->nama }}</h5>

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

                        

                        <div class="row mb-3">
                            <div class="col-12">
                                <canvas id="chart-{{ $id_produk }}"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    <div class="footer">
        <p>Generated by Laravel PDF</p>
    </div>
</body>

</html>
