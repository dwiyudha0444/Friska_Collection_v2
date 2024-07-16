@extends('admin.index')
@section('content')
<style>
    .full-page-background {
        background-color: #f8f9fa; /* Adjust the color as needed */
        min-height: 100vh; /* Ensure it covers the full height of the viewport */
        display: flex;
        flex-direction: column;
    }
</style>
<main id="main" class="main full-page-background">
    <div class="pagetitle">
        <h1>Prediksi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">admin</a></li>
                <li class="breadcrumb-item active">Kelola Prediksi Penjualan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Penjualan Terbaru -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="card-body">
                <h5 class="card-title">Prediksi Penjualan</h5>
                <div class="d-flex justify-content-center">
                    <div class="btn-group" role="group">
                        <a href="{{ route('prediksi_hitung_bulandepan') }}" class="btn btn-primary me-2">
                            Hitung bulan depan
                        </a>
                        <a href="{{ route('prediksi_hitung_bulansebelumnya') }}" class="btn btn-secondary">
                            Hitung bulan sebelumnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Penjualan Terbaru -->
</main>
@endsection
