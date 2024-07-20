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
                    <a href="{{ route('all-prediksi') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            title="Tambah Data Film" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                            <path
                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z" />
                        </svg>
                    </a>

                    <form method="POST" action="{{ route('pilih-produk') }}">
                        @csrf
                        {{-- <div class="form-group">
                        <label for="id_periode">Pilih Periode:</label>
                        <select name="id_periode" id="id_periode" class="form-control">
                            @foreach ($periode as $p)
                                <option value="{{ $p->periode }}">{{ $p->periode }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                        <div class="form-group">
                            <label for="id_periode">Pilih Periode:</label>
                            <input type="text" name="id_periode" id="id_periode" class="form-control"
                                list="periode-list">
                            {{-- <datalist id="periode-list">
                                @foreach ($periode as $p)
                                    <option value="{{ $p->periode }}">{{ $p->periode }}</option>
                                @endforeach
                            </datalist> --}}
                        </div>

                        </br>
                        <button type="submit" class="btn btn-primary">Hitung</button>
                        </br>
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
