<!-- Modal -->
<div class="modal fade" id="confirmationApprove-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmationApproveLabel" aria-hidden="true">
    <div class="modal-dialog">
     <form action="/account-request/approval/{{ $item->id }}" method="post">
        @csrf
        @method('POST')
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmationApproveLabel">Konfirmasi aktifkan</h5>
              <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="for" value="activate">
                <span>Apakah Anda yakin ingin mengaktifkan akun ini?</span>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-success" >Ya, aktifkan!</button>
            </div>
          </div></form>
    </div>
  </div>
