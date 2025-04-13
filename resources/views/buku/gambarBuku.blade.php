<div class="modal fade" id="modal-gambar-{{ $item->id_buku }}" tabindex="-1" aria-labelledby="modalGambarLabel{{ $item->id_buku }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGambarLabel{{ $item->id_buku }}">Gambar Buku: {{ $item->judul }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{$item->cover}}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>