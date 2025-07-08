<!-- Modal -->
<div class="modal fade" id="detailAccount-{{ $item->id }}" tabindex="-1" aria-labelledby="detailAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailAccountLabel">Detail Akun</h5>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" value="{{ optional($item->user)->name }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ optional($item->user)->email }}" readonly>
                </div>

                @if($item->ktp_file)
                    <div class="form-group mb-3 text-center">
                        <label class="d-block mb-2"><strong>Foto KTP</strong></label>
                        <img src="{{ asset('storage/' . $item->ktp_file) }}" alt="Foto KTP" class="img-thumbnail shadow-sm" style="max-height: 250px; max-width: 100%; object-fit: contain;">
                    </div>
                @else
                    <p class="text-muted">Belum ada foto KTP yang diunggah.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
