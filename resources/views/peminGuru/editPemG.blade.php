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
                        <li class="breadcrumb-item"><a href="{{ url('/peminGuru') }}">Peminjaman</a></li>
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
                <form method="POST" action="{{ route('peminGuru.update', $peminjaman->id_peminjaman) }}" id="editPeminjamanForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_peminjaman">Kode Peminjaman</label>
                                <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" value="{{$peminjaman->id_peminjaman}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="guru_id">Nama Peminjam</label>
                                <select class="form-control choices" id="guru_id" name="guru_id" required>
                                    @foreach($guru as $s)
                                        <option value="{{$s->id_guru}}" {{$peminjaman->guru_id == $s->id_guru ? 'selected' : ''}}>{{$s->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="{{$peminjaman->tgl_pinjam}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                                <div class="mb-3">
                                    <select class="form-select buku_id" name="buku_id[]">
                                        <option value="">Pilih Buku</option>
                                        @foreach($buku as $b)
                                            <option value="{{ $b->id_buku }}" {{ $detail->buku_id == $b->id_buku ? 'selected' : '' }} {{ $b->jumlah <= 0 && $detail->buku_id != $b->id_buku ? 'disabled' : '' }}>
                                                {{ $b->judul }} (Tersedia: {{ $b->jumlah }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3" style="display: none">
                            <input type="text" class="form-control" id="status" name="status" value="Dipinjam">
                            <input type="hidden" name="tipe" value="guru">
                        </div>  
                        <button type="button" id="add-book-btn" class="btn btn-secondary mt-3">Tambah Buku</button>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update Peminjaman</button>
                        <a href="{{ url('/peminGuru') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<template id="book-entry-template">
    <div class="mb-3 book-entry">
        <label class="form-label">Kode Buku</label>
        <div class="d-flex align-items-center">
            <select class="form-select buku_id" name="buku_id[]">
                <option value="">Pilih Buku</option>
                @foreach($buku as $item)
                    <option value="{{ $item->id_buku }}" {{ $item->jumlah <= 0 ? 'disabled' : '' }}>
                        {{ $item->judul }} (Tersedia: {{ $item->jumlah }})
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</template> 
@endsection
