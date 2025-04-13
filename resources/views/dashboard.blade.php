@extends('layout.main')

@section('title', 'Dashboard')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <p class="text-subtitle text-muted">Statistik Perpustakaan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Card pertama -->
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon blue mb-2">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Pengunjung Perpustakaan</h6>
                            <h6 class="font-extrabold mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah Pengunjung Perpustakaan">{{ $kunjungan ? $kunjungan->jumlah : 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Card kedua -->
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon red mb-2">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Jumlah Buku Perpustakaan</h6>
                            <h6 class="font-extrabold mb-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah Buku Perpustakaan">{{ $buku ? $buku->jumlah : 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Bar Chart Peminjaman Per Tahun</h4>
                        <!-- Dropdown untuk memilih tahun -->
                        <div>
                            <label for="tahunSelect" class="form-label me-2">Pilih Tahun:</label>
                            <select id="tahunSelect" class="form-select d-inline-block w-auto">
                                <!-- Opsi akan diisi oleh JavaScript -->
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="bar" data-peminjaman="{{ json_encode($frontendData) }}"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection


