@section('formpem')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Pengunjung</h4>
    </div>
    <div class="card-body">
        <form action="/kunjunganGuru/store" method="POST" id="kunjunganForm">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">Data Transaksi</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="id_kunjungan" class="form-label">No Pengunjung</label>
                                <input type="text" class="form-control id_kunjunganGuru" id="id_kunjungan" name="id_kunjungan" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="guru_ku" class="form-label">Daftar Guru</label>
                                <select class="form-select choices" id="guru_ku" name="guru_ku" data-parsley-required="true">
                                    <option value="">Pilih Anggota</option>
                                    @foreach($guru as $item)
                                        <option value="{{ $item->id_guru }}">{{ $item->id_guru }} - {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <select class="form-select" id="tujuan" name="tujuan">
                                    <option value="Menulis">Menulis</option>
                                    <option value="Membaca">Membaca</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">Pinjam Buku</h5>
                        </div>
                        <div class="card-body">
                            <div id="book-list">
                                <div class="mb-3">
                                    <label for="buku_ku" class="form-label">Kode Buku</label>
                                    <select class="form-select buku_id" name="buku_ku">
                                        <option value="">Pilih Buku</option>
                                        @foreach($buku as $item)
                                            <option value="{{ $item->id_buku }}">
                                                {{ $item->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>                     
        </form>
    </div>
</div>
@endsection
