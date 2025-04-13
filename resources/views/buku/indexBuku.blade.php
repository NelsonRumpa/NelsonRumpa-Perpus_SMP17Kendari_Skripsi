@extends('layout.main')

@section('title', 'Buku')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Buku</h3>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
                        Tambah Data
                    </button>
                </div>
                @include('buku.formBuku')
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buku</li>
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
              <div class="table-responsive">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 10%">No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>ISBN</th>
                            <th>Jumlah</th>
                            <th style="width: 15%" class="no-export">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buku as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->judul}}</td>
                            <td>{{$item->kategori->nama}}</td>
                            <td>{{$item->rak->lokasi}}</td>
                            <td>{{$item->penulis}}</td>
                            <td>{{$item->penerbit}}</td>
                            <td>{{$item->tahun_terbit}}</td>
                            <td>{{$item->ISBN}}</td>
                            <td>{{$item->jumlah}}</td>
                            <td class="no-export">
                                <form action="/buku/{{$item->id_buku}}" method="GET">
                                    @csrf
                                    @method('delete')
                                    <a href="/buku/{{$item->id_buku}}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit" style="color: white"></i></a>
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-gambar-{{ $item->id_buku}}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </form>
                          </td>
                        </tr>
                       
                        @push('modals')
                            @include('buku.gambarBuku', ['item' => $item])
                        @endpush
                        
                        @endforeach
                      </tbody>
                </table>
              </div>
            </div>
        </div>
    </section>
</div>
@endsection
