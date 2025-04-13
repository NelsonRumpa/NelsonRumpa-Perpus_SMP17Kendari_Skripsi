@extends('layout.main')

@section('title', 'Update Buku')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Layout Default</h3>
                <p class="text-subtitle text-muted">The default layout.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Layout Default</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <form method="POST" action="/buku/{{$buku->id_buku}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{$buku->judul}}" required>
                    </div>                    
                    <div class="mb-3">
                        <label for="cover" class="form-label">Sampul Buku</label>
                        <input type="file" class="form-control" id="cover" name="cover">
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori Buku</label>
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                            @foreach($kategori as $item)
                                <option value="{{ $item->id_kat }}" {{ $item->id_kat == $buku->kategori_id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rak_id" class="form-label">Lokasi Buku</label>
                        <select class="form-control" id="rak_id" name="rak_id" required>
                            @foreach($rakbuku as $item)
                                <option value="{{ $item->id_rak }}" {{ $item->id_rak == $buku->rak_id ? 'selected' : '' }}>
                                    {{ $item->lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Buku</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{$buku->jumlah}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Nama Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value="{{$buku->penulis}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="ISBN" class="form-label">ISBN</label>
                        <input type="text" class="form-control" id="ISBN" name="ISBN" value="{{$buku->ISBN}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{$buku->penerbit}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{$buku->tahun_terbit}}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection