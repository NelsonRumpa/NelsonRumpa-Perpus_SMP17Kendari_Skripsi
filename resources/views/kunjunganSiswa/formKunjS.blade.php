@section('formpem')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Pengunjung</h4>
    </div>
    <div class="card-body">
        <form action="/kunjunganSiswa/store" method="POST" id="kunjunganForm">
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
                                <input type="text" class="form-control id_kunjunganSiswa" id="id_kunjungan" name="id_kunjungan" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="siswa_ku" class="form-label">ID Anggota</label>
                                <select class="form-select choices" id="siswa_ku" name="siswa_ku" data-parsley-required="true">
                                    <option value="">Pilih Anggota</option>
                                    @foreach($siswa as $item)
                                        <option value="{{ $item->id_siswa }}">{{ $item->id_siswa }} - {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select id="kelas" name="kelas" class="choices2 form-select">
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
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <select id="tujuan" name="tujuan"  class="form-select">
                                    <option value="Menulis">Menulis</option>
                                    <option value="Membaca">Membaca</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">Buku</h5>
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
