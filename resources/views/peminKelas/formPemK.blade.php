@section('formpem')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Peminjaman Buku</h4>
    </div>
    <div class="card-body">
        <form action="/peminKelas/store" method="POST" id="peminjamanForm">
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
                                <input type="text" class="form-control id_peminjamanKelas" id="id_peminjaman" name="id_peminjaman" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select id="kelas" name="kelas" class="choices form-select">
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
                                <label for="keterangan" class="form-label">Keterangan Nama Guru</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" required data-parsley-required="true"></input>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_pinjam" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam">
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
                                    <select class="form-select buku_id" name="buku_id[]" required data-parsley-required="true">
                                        <option value="">Pilih Buku</option>
                                        @foreach($buku as $item)
                                            <option value="{{ $item->id_buku }}" {{ $item->jumlah <= 0 ? 'disabled' : '' }}>
                                                {{ $item->judul }} (Tersedia: {{ $item->jumlah }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah Pinjam</label>
                                    <input type="number" class="form-control jumlah" name="jumlah[]" min="1" placeholder="Masukkan jumlah" data-parsley-required="true">
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
</script>
@endsection
