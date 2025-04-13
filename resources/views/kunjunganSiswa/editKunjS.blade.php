@extends('layout.main')

@section('title', 'Edit Kunjungan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Kunjungan</h3>
                <p class="text-subtitle text-muted">Form untuk mengedit data Kunjungan.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Kunjungan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Kunjungan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Kunjungan</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kunjunganSiswa.update', $kunjungan->id_kunjungan) }}" id="editKunjunganForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_kunjungan">Kode Pengunjung</label>
                                <input type="text" class="form-control" id="id_kunjungan" name="id_kunjungan" value="{{$kunjungan->id_kunjungan}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="siswa_ku">Nama Pengunjung</label>
                                <select class="form-control choices" id="siswa_ku" name="siswa_ku" required>
                                    @foreach($siswa as $s)
                                        <option value="{{$s->id_siswa}}" {{$kunjungan->siswa_ku == $s->id_siswa ? 'selected' : ''}}>{{$s->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select id="kelas" name="kelas" class="choices2 form-select">
                                    <option value="{{$kunjungan->kelas}}">{{$kunjungan->kelas}}</option>
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
                            <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="form-control">
                                    <option value="Menulis" {{ $kunjungan->tujuan == 'Menulis' ? 'selected' : '' }}>Menulis</option>
                                    <option value="Membaca" {{ $kunjungan->tujuan == 'Membaca' ? 'selected' : '' }}>Membaca</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{$kunjungan->keterangan}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="buku_ku">Buku yang DiPakai</label>
                        <div id="book-list">
                                <div class="mb-3">
                                    <select class="form-control buku_id" id="buku_ku" name="buku_ku">
                                    <option value="">Pilih Buku</option>
                                    @foreach($buku as $b)
                                        <option value="{{$b->id_buku}}" {{$kunjungan->buku_ku == $b->id_buku ? 'selected' : ''}}>{{$b->judul}}</option>
                                    @endforeach
                                </select>
                                </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update Kunjungan</button>
                        <a href="{{ url('/kunjunganSiswa') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
