@extends('layout.main')

@section('title', 'Pengunjungan guru')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Peminjaman</h3>
                @include('kunjunganGuru.formKunjG')
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kunjungan Guru</li>
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
                <h4 class="card-title">Data Kunjungan</h4>
                
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kunjungan</th>
                            <th>Nama Pengunjung</th>
                            <th>Tujuan</th>
                            <th>Buku</th>
                            <th>Tanggal Kunjungan</th>
                            <th class="no-export" style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kunjungan as $item)
                        @if($item->guru_ku)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->id_kunjungan}}</td>
                                    <td>{{$item->guru->nama}}</td>
                                    <td>{{$item->tujuan}}</td>
                                    <td>
                                        @if($item->buku)
                                            {{ $item->buku->judul }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{$item->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <form action="/kunjunganGuru/{{$item->id_kunjungan}}" method="GET">
                                            @csrf
                                            @method('delete')
                                            <a href="/kunjunganGuru/{{$item->id_kunjungan}}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit" style="color: white"></i></a>
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
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