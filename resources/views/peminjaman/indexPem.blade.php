@extends('layout.main')

@section('title', 'Peminjaman')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Peminjaman</h3>
                @include('peminjaman.formpem')
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
                            <th>Tanggal Pengembalian</th>
                            <th>Sisa Waktu</th>
                            <th>Status</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sortedPeminjaman = $peminjaman->sortByDesc(function ($item) {
                                return $item->status === 'Dipinjam' ? 1 : 0;
                            });
                        @endphp
                        @foreach ($sortedPeminjaman as $item)
                        @if($item->siswa_id)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->id_peminjaman}}</td>
                                    <td>{{$item->siswa->nama}}</td>
                                    <td>
                                        <ul>
                                            @foreach($item->details as $detail)
                                                <li>{{$detail->buku->judul}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</td>  
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') }}</td>  
                                    <td>  
                                        @if($item->status === 'Dikembalikan')  
                                            <span class="badge bg-success">Sudah dikembalikan</span>  
                                        @else  
                                            @php  
                                                $sekarang = \Carbon\Carbon::now();  
                                                $tglKembali = \Carbon\Carbon::parse($item->tgl_kembali);  
                                                $sisaWaktu = $sekarang->diffInDays($tglKembali, false) + 1; // Menambahkan 1 hari  
                                            @endphp  
                                            @if($sisaWaktu > 0)  
                                                <span class="badge bg-primary">{{ $sisaWaktu }} hari lagi</span>  
                                            @elseif($sisaWaktu == 0)  
                                                <span class="badge bg-warning">Hari ini</span>  
                                            @else  
                                                <span class="badge bg-danger">Terlambat {{ abs($sisaWaktu) }} hari</span>  
                                            @endif  
                                        @endif  
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->status === 'Dipinjam' ? 'danger' : 'success' }}">
                                            {{$item->status}}
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->status === 'Dipinjam')
                                            <form action="{{ route('peminjaman.return', $item->id_peminjaman) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>
                                            <a href="/peminjaman/{{$item->id_peminjaman}}/edit" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit" style="color: white"></i>
                                            </a>
                                        @endif
                                        <form action="/peminjaman/{{$item->id_peminjaman}}" method="GET" style="display:inline;">
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