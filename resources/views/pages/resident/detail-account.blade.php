<!-- Modal -->
<div class="modal fade" id="detailAccount-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmationDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
     <<div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detailAccountLabel">Detail Akun</h5>
              <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ optional($item->user)->name }}" readonly="readonly">
                <input type="email" class="form-control" id="email" name="email" value="{{ optional($item->user)->email }}" readonly="readonly">
               </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
    </div>
  </div>
