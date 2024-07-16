@extends('admin.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Form Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Form Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Data</h5>

                            <div id="dataContainer">
                                <!-- Data akan ditampilkan di sini -->
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', (event) => {
                                    const formData = JSON.parse(localStorage.getItem('formData'));
                                    if (formData) {
                                        document.getElementById('dataContainer').innerHTML = `
                                        <div class="alert alert-info">
                                            <strong>Success!</strong> Here is the data you submitted.<br><br>
                                            <ul>
                                                <li><strong>Produk:</strong> ${formData.produk}</li>
                                                <li><strong>Bulan:</strong> ${formData.bulan}</li>
                                                <li><strong>Periode:</strong> ${formData.periode}</li>
                                            </ul>
                                        </div>
                                    `;
                                    } else {
                                        document.getElementById('dataContainer').innerHTML = `
                                        <div class="alert alert-warning">
                                            No data available.
                                        </div>
                                    `;
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
