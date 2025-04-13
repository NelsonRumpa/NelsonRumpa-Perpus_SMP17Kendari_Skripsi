@extends('layout.main')

@section('title', 'Rak Buku')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Rak Buku</h3>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
                        Tambah Data
                    </button>
                </div>
                @include('rakbuku.formRak')
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rak Buku</li>
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
                            <th>No</th>
                            <th>Lokasi</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rakbuku as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->lokasi}}</td>
                                    <td>
                                        <form action="/rakbuku/{{$item->id_rak}}" method="GET">
                                            @method('delete')
                                            <a href="/rakbuku/{{$item->id_rak}}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit" style="color: white"></i></a>
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </section>
</div>
@endsection
