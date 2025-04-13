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
                        <li class="breadcrumb-item"><a href="{{ url('/peminKelas') }}">Peminjaman</a></li>
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
                <form method="POST" action="{{ route('peminKelas.update', $peminjaman->id_peminjaman) }}" id="editPeminjamanForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_peminjaman">Kode Peminjaman</label>
                                <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" value="{{$peminjaman->id_peminjaman}}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select id="kelas" name="kelas" class="choices form-select">
                                    <option value="{{$peminjaman->kelas}}">{{$peminjaman->kelas}}</option>
                                    <option value="7.1">7.1</option>
                                    <option value="7.2">7.2</option>
                                    <option value="7.3">7.3</option>
                                    <option value="7.4">7.4</option>
                                    <option value="7.5">7.5</option>
                                    <option value="7.6">7.6</option>
                                    <option value="7.7">7.7</option>
                                    <option value="7.8">7.8</option>
                                    <option value="8.1">8.1</option>
                                    <option value="8.2">8.2</option>
                                    <option value="8.3">8.3</option>
                                    <option value="8.4">8.4</option>
                                    <option value="8.5">8.5</option>
                                    <option value="8.6">8.6</option>
                                    <option value="8.7">8.7</option>
                                    <option value="8.8">8.8</option>
                                    <option value="9.1">9.1</option>
                                    <option value="9.2">9.2</option>
                                    <option value="9.3">9.3</option>
                                    <option value="9.4">9.4</option>
                                    <option value="9.5">9.5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan Nama Guru</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$peminjaman->keterangan}}"></input>
                            </div>
                            <div class="form-group">
                                <label for="tgl_pinjam">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="{{$peminjaman->tgl_pinjam}}" required>
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
                                            <option value="{{ $b->id_buku }}" {{ $detail->buku_id == $b->id_buku ? 'selected' : '' }} 
                                                {{ $b->jumlah <= 0 && $detail->buku_id != $b->id_buku ? 'disabled' : '' }}>
                                                {{ $b->judul }} (Tersedia: {{ $b->jumlah }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah">Jumlah Pinjam</label>
                                    <input type="number" class="form-control jumlah" name="jumlah[]" value="{{ $detail->jumlah }}" min="1" placeholder="Masukkan jumlah">
                                </div>
                            @endforeach
                        </div>
                    </div>                    
                    <div class="mb-3" style="display: none">
                        <input type="text" class="form-control" id="status" name="status" value="Dipinjam">
                    </div> 
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update Peminjaman</button>
                        <a href="{{ url('/peminKelas') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
