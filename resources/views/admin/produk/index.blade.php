@extends('admin.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Product Fashion</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}">admin</a></li>
                    <li class="breadcrumb-item active">Fashion</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body">
                    <h5 class="card-title">Fashion</span></h5>
                    {{-- <a href="{{ route('obat.create') }}"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                            height="30" fill="currentColor" title="Tambah Data Film" class="bi bi-bookmark-plus"
                            viewBox="0 0 16 16">
                            <path
                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z" />
                        </svg></a> --}}
                    <table class="table table-borderless datatable ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                                {{-- @if (auth()->user()->role == 'apoteker' || auth()->user()->role == 'kepala apoteker')
                                    <th scope="col">Action</th>
                                @endif --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($fashion as $fash)
                                <tr>
                                    <th scope="row"><a href="#">{{ $no++ }}</a></th>
                                    
                                    <td>{{ $fash->nama }}</td>
                                    <td>{{ $fash->kategori }}</td>
                                    <td>{{ $fash->harga }}</td>
                                    <td>{{ $fash->image }}</td>
                                    
                                    {{-- <td>

                                        <form method="POST" action="{{ route('obat.destroy', $fash->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="custom-btn custom-btn-merah">Hapus</button>

                                            <a class="custom-btn" href="{{ url('obat-edit', $fash->id) }}">Edit</a>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Recent Sales -->
    </main>
@endsection