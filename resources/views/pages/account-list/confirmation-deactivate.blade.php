<!-- Modal -->
<div class="modal fade" id="confirmationReject-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmationRejectLabel" aria-hidden="true">
    <div class="modal-dialog">
     <form action="/account-request/approval/{{ $item->id }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmationRejectLabel">Konfirmasi Nonaktif</h5>
              <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="for" value="deactivate">
                <span>Apakah Anda yakin ingin Menonaktifkan akun ini?</span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-outline btn-danger" >Ya!</button>
            </div>
          </div></form>
    </div>
  </div>
