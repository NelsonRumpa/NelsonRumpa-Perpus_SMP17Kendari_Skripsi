@section('formpem')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Peminjaman Buku</h4>
    </div>
    <div class="card-body">
        <form action="/peminjaman/store" method="POST" id="peminjamanForm">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">Data Transaksi</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="id_peminjaman" class="form-label">No Peminjaman</label>
                                <input type="text" class="form-control id_peminjamanSiswa" id="id_peminjaman" name="id_peminjaman" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="siswa_id" class="form-label">ID Anggota</label>
                                <select class="form-select choices" id="siswa_id" name="siswa_id" required data-parsley-required="true">
                                    <option value="">Pilih Anggota</option>
                                    @foreach($siswa as $item)
                                        <option value="{{ $item->id_siswa }}">{{ $item->id_siswa }} - {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="mb-3">
                                <label for="tgl_pinjam" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam">
                            </div>
                            <div class="mb-3">
                                <label for="durasi_pinjam" class="form-label">Durasi Peminjaman</label>
                                <select class="form-select" id="durasi_pinjam" name="durasi_pinjam">
                                    <option value="3">3 Hari</option>
                                    <option value="365">1 Tahun</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_kembali" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" readonly>
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
                                    <label for="buku_id" class="form-label">Kode Buku</label>
                                    <select class="form-select buku_id" name="buku_id[]" required data-parsley-required="true" data-parsley-mincheck="1" multiple>
                                        <option value="">Pilih Buku</option>
                                        @foreach($buku as $item)
                                            <option value="{{ $item->id_buku }}" {{ $item->jumlah <= 0 ? 'disabled' : '' }}>
                                                {{ $item->judul }} (Tersedia: {{ $item->jumlah }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3" style="display: none">
                <input type="text" class="form-control" id="status" name="status" value="Dipinjam">
            </div>  
            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>                     
        </form>
    </div>
</div>
@endsection
