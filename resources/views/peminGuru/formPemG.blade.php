@section('formpem')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Peminjaman Buku</h4>
    </div>
    <div class="card-body">
        <form action="/peminGuru/store" method="POST" id="peminjamanForm">
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
                                <input type="text" class="form-control id_peminjamanGuru" id="id_peminjaman" name="id_peminjaman" readonly>
                            </div>
                            <div class="mb-3 form-group mandatory" data-bs-theme="dark">
                                <label for="guru_id" class="form-label">ID Anggota</label>
                                <select class="form-select choices" id="guru_id" name="guru_id" data-parsley-required="true">
                                    <option value="">Pilih Anggota</option>
                                    @foreach($guru as $item)
                                        <option value="{{ $item->id_guru }}">{{ $item->id_guru }} - {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_pinjam" class="form-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam">
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
                                    <select class="form-select buku_id" name="buku_id[]" data-parsley-required="true" data-parsley-mincheck="1" multiple>
                                        <option value="">Pilih Buku</option>
                                        @foreach($buku as $item)
                                            <option value="{{ $item->id_buku }}" {{ $item->jumlah <= 0 ? 'disabled' : '' }}>
                                                {{ $item->judul }} (Tersedia: {{ $item->jumlah }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <button type="button" id="add-book-btn" class="btn btn-secondary mt-3">Tambah Buku</button> --}}
                        </div>
                        {{-- <template id="book-entry-template">
                            <div class="mb-3 book-entry">
                                <label class="form-label">Kode Buku</label>
                                <div class="d-flex align-items-center">
                                    <select class="form-select buku_id" name="buku_id[]">
                                        <option value="">Pilih Buku</option>
                                        @foreach($buku as $item)
                                            <option value="{{ $item->id_buku }}" {{ $item->jumlah <= 0 ? 'disabled' : '' }}>
                                                {{ $item->judul }} (Tersedia: {{ $item->jumlah }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-danger btn-sm ms-2 delete-book">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </template>                                           --}}
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

{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    $('#peminjamanForm').on('submit', function(e) {
        // Hapus entri buku yang kosong
        $('.buku_id').filter(function() {
            return !this.value;
        }).closest('.mb-3').remove();

        // Cek apakah ada buku yang dipilih
        if ($('.buku_id').filter(function() { return this.value; }).length === 0) {
            alert('Pilih setidaknya satu buku');
            e.preventDefault();
        }
    });

    $('#add-book-btn').click(function() {
        var newBookEntry = $('#book-entry-template').html();
        $('#book-list').append(newBookEntry);

        // Inisialisasi ulang Select2 untuk entri buku baru
        $('#book-list .buku_id:last').select2({
            placeholder: "Pilih Buku",
            allowClear: true,
            width: '100%'
        });
    });
});
</script> --}}
@endsection
