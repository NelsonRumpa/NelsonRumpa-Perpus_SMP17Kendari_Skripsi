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
                <form method="POST" action="{{ route('kunjunganGuru.update', $kunjungan->id_kunjungan) }}" id="editKunjunganForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_kunjungan">Kode Pengunjung</label>
                                <input type="text" class="form-control" id="id_kunjungan" name="id_kunjungan" value="{{$kunjungan->id_kunjungan}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="guru_ku">Nama Pengunjung</label>
                                <select class="form-control choices" id="guru_ku" name="guru_ku" required>
                                    @foreach($guru as $s)
                                        <option value="{{$s->id_guru}}" {{$kunjungan->guru_ku == $s->id_guru ? 'selected' : ''}}>{{$s->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <select name="tujuan" id="tujuan" class="form-control" required title="Silakan pilih tujuan">
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
                        <a href="{{ url('/kunjunganGuru') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
