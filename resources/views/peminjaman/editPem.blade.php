@extends('layout.main')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Peminjaman</h3>
                <p class="text-subtitle text-muted">Form untuk mengedit data peminjaman.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/peminjaman') }}">Peminjaman</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Peminjaman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Peminjaman</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/peminjaman/{{$peminjaman->id_peminjaman}}" id="editPeminjamanForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_peminjaman">Kode Peminjaman</label>
                                <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" value="{{$peminjaman->id_peminjaman}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="siswa_id">Nama Peminjam</label>
                                <select class="form-control choices" id="siswa_id" name="siswa_id" required>
                                    @foreach($siswa as $s)
                                        <option value="{{$s->id_siswa}}" {{$peminjaman->siswa_id == $s->id_siswa ? 'selected' : ''}}>{{$s->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="{{$peminjaman->tgl_pinjam}}" required>
                            </div>
                            <div class="form-group">
                                <label for="durasi_pinjam">Durasi Peminjaman</label>
                                <select class="form-select" id="durasi_pinjam" name="durasi_pinjam">
                                    @php
                                        $tglPinjam = \Carbon\Carbon::parse($peminjaman->tgl_pinjam);
                                        $tglKembali = \Carbon\Carbon::parse($peminjaman->tgl_kembali);
                                        $durasi = $tglPinjam->diffInDays($tglKembali);
                                    @endphp
                                    <option value="3" {{ $durasi == 3 ? 'selected' : '' }}>3 Hari</option>
                                    <option value="365" {{ $durasi == 365 ? 'selected' : '' }}>1 Tahun</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_kembali">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="{{$peminjaman->tgl_kembali}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{$peminjaman->keterangan}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="buku_id">Buku yang Dipinjam</label>
                        <div id="book-list">
                            @foreach($peminjaman->details as $detail)
                                <div class="mb-3 d-flex align-items-center">
                                    <select class="form-select buku_id me-2" name="buku_id[]" style="width: 95%;">
                                        <option value="">Pilih Buku</option>
                                        @foreach($buku as $b)
                                            <option value="{{ $b->id_buku }}" {{ $detail->buku_id == $b->id_buku ? 'selected' : '' }} {{ $b->jumlah <= 0 && $detail->buku_id != $b->id_buku ? 'disabled' : '' }}>
                                                {{ $b->judul }} (Tersedia: {{ $b->jumlah }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_returned[]" value="{{ $detail->buku_id }}" {{ $detail->is_returned ? 'checked' : '' }}>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-book-btn" class="btn btn-secondary mt-3">Tambah Buku</button>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update Peminjaman</button>
                        <a href="{{ url('/peminjaman') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<template id="book-entry-template">
    <div class="mb-3 d-flex align-items-center">
        <select class="form-select buku_id me-2" name="buku_id[]" style="width: 95%;">
            <option value="">Pilih Buku</option>
            @foreach($buku as $b)
                <option value="{{ $b->id_buku }}" {{ $b->jumlah <= 0 ? 'disabled' : '' }}>
                    {{ $b->judul }} (Tersedia: {{ $b->jumlah }})
                </option>
            @endforeach
        </select>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_returned[]" value="">
        </div>
    </div>
</template>
@endsection
