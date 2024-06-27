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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($selectedData as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->created_at->format('F') }}</td>
                                    <td>{{ $data->kategori->nama }}</td>
                                    <td>{{ $data->ma }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
