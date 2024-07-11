@extends('admin.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                    <li class="breadcrumb-item">Forms</li>
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
                            <form method="POST" action="{{ route('update_user', $users->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @if (session('failed'))
                                    <div class="alert alert-danger">
                                        {{ session('failed') }}
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $users->name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="email" class="form-control"
                                            value="{{ $users->email }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="role">
                                            <option>-- Pilih Kategori --</option>
                                            <option value="pemilik" {{ $users->role == 'pemilik' ? 'selected' : '' }}>
                                                Pemilik</option>
                                            <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="karyawan" {{ $users->role == 'karyawan' ? 'selected' : '' }}>
                                                Karyawan</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="status">
                                            <option>-- Pilih Status --</option>
                                            <option value="aktif" {{ $users->status == 'aktif' ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="nonaktif" {{ $users->status == 'nonaktif' ? 'selected' : '' }}>
                                                Nonaktif</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Simpan</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main><!-- End #main -->
@endsection
