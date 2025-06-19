@extends('layouts.app')

@section('title', 'Permintaan Akun')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>
</div>



<div class="card shadow">
    <div class="card-body">
        <div style="overflow-x: auto;">
            <table id="table" class="table table-bordered table-hover" style="min-width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $item)
                    <tr>
                        <td>{{ $users->firstItem() + $index }}</td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->email}}</td>
                        <td>
                            <div class="d-flex" style="gap: 10px">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationReject-{{ $item->id }}">Tolak</button>
                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmationApprove-{{ $item->id }}">Setuju</button>

                            </div>
                        </td>
                    </tr>
                    @include('pages.account-request.confirmation-reject', ['item' => $item])
                    @include('pages.account-request.confirmation-approve', ['item' => $item])
                  @empty
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($users->hasPages())
    <div class="card-footer">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection


{{--
@push('scripts')


@endpush --}}



@section('scripts')
<script>
    // SweetAlert untuk notifikasi sukses/gagal
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif

    // Fungsi konfirmasi hapus
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection

