@extends('admin.index')
@section('content')
<main id="main" class="main">
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

                <form method="POST" action="{{ route('riwayat_hasil_prediksi') }}">
                    @csrf
                    <div class="form-group">
                        <label for="id_periode">Pilih Periode:</label>
                        <select name="id_periode" id="id_periode" class="form-control">
                            @foreach ($periode as $p)
                                <option value="{{ $p->periode }}">{{ $p->periode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="bulan">Pilih Bulan:</label>
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    
                    <br/>
                    <button type="submit" class="btn btn-primary">Hitung</button>
                    <br/>
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($prediksi as $pre)
                                <tr>
                                    <td><input type="checkbox" name="selected_ids[]" value="{{ $pre->id }}"></td>
                                    <th scope="row"><a href="#">{{ $no++ }}</a></th>
                                    <td>{{ $pre->nama }}</td>
                                    <td>{{ $pre->kategori->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div><!-- End Penjualan Terbaru -->
</main>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Checkbox Pilih Semua
    document.getElementById('select-all').addEventListener('click', function(event) {
        const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });
});
</script>
