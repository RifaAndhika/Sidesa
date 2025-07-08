<!-- Modal -->
<div class="modal fade" id="confirmationApprove-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmationApproveLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/account-request/approval/{{ $item->id }}" method="post">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationApproveLabel">Konfirmasi Setujui</h5>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="for" value="approve">

                    <p><strong>Nama:</strong> {{ $item->name }}</p>
                    <p><strong>Email:</strong> {{ $item->email }}</p>

                    @if($item->resident && $item->resident->ktp_file)
                        <div class="mb-3 text-center">
                            <label class="d-block mb-2"><strong>Foto KTP:</strong></label>
                            <img
                                src="{{ asset('storage/' . $item->resident->ktp_file) }}"
                                alt="Foto KTP"
                                class="img-thumbnail shadow-sm"
                                style="max-height: 250px; max-width: 100%; object-fit: contain;"
                            >
                        </div>
                    @else
                        <p class="text-muted">Belum upload foto KTP.</p>
                    @endif

                    <span>Apakah Anda yakin ingin menyetujui akun ini?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ya, Setujui!</button>
                </div>
            </div>
        </form>
    </div>
</div>
