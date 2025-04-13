@extends('layout.main')

@section('title', 'Peminjaman Guru')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Peminjaman</h3>
                @include('peminGuru.formPemG')
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        @yield('formpem')
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Peminjaman</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjam</th>
                            <th>Nama Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Status</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sortedPeminGuru = $peminjaman->sortByDesc(function ($item) {
                                return $item->status === 'Dipinjam' ? 1 : 0;
                            });
                        @endphp
                        @foreach ($sortedPeminGuru as $item)
                        @if($item->guru_id)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->id_peminjaman}}</td>
                                    <td>{{$item->guru->nama}}</td>
                                    <td>
                                        <ul>
                                            @foreach($item->details as $detail)
                                                <li>{{$detail->buku->judul}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{$item->tgl_pinjam}}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->status === 'Dipinjam' ? 'danger' : 'success' }}">
                                            {{$item->status}}
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->status === 'Dipinjam')
                                            <form action="{{ route('peminGuru.return', $item->id_peminjaman) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>
                                            <a href="/peminGuru/{{$item->id_peminjaman}}/edit" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit" style="color: white"></i>
                                            </a>
                                        @endif
                                        <form action="/peminGuru/{{$item->id_peminjaman}}" method="GET" style="display:inline;">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td> 
                                </tr>
                                @endif
                                @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </section>
</div>
@endsection