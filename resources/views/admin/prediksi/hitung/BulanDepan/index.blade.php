@extends('admin.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Form</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form</h5>

                            <!-- General Form Elements -->
                            <form id="formKategori">
                                <div class="row mb-3">
                                    <label for="produk" class="col-sm-2 col-form-label">Produk</label>
                                    <div class="col-sm-10">
                                        <select name="produk" id="produk" class="form-control">
                                            @foreach($produkList as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="bulan" id="bulan" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="periode" class="col-sm-2 col-form-label">Periode</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="periode" id="periode" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Simpan</label>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary"
                                            onclick="simpanData()">Simpan</button>
                                    </div>
                                </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan tanggal saat ini
            var currentDate = new Date();

            // Mendapatkan bulan depan
            var nextMonth = currentDate.getMonth() + 2; // +1 untuk mendapatkan bulan depan
            var nextYear = currentDate.getFullYear();

            // Jika bulan adalah Desember, atur tahun ke tahun berikutnya
            if (nextMonth === 12) {
                nextMonth = 1; // Kembali ke bulan Januari
                nextYear++;
            }

            // Daftar nama bulan
            var monthNames = [
                "Januari", "Februari", "Maret",
                "April", "Mei", "Juni", "Juli",
                "Agustus", "September", "Oktober",
                "November", "Desember"
            ];

            // Ambil nama bulan sesuai dengan indeks
            var nextMonthName = monthNames[nextMonth - 1]; // -1 karena indeks dimulai dari 0

            // Set nilai input
            document.getElementById('bulan').value = nextMonthName + ' ' + nextYear;
        });

        function simpanData() {
            const bulan = document.getElementById('bulan').value;
            const periode = document.getElementById('periode').value;
            const produk = document.getElementById('produk').value;

            // Simpan data bulan, periode, dan produk ke localStorage
            localStorage.setItem('formData', JSON.stringify({
                bulan,
                periode,
                produk
            }));

            // Redirect ke halaman lain untuk menampilkan data
            window.location.href = "{{ route('hasil_prediksi') }}";
        }
    </script>
@endsection
