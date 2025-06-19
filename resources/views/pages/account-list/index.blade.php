@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Daftar Akun Penduduk</h1>
</div>




<div class="row">
        <div class="col">
                <div class="card shadow">
                      <div class="card-body">
                     <div style="overflow-x: auto;">
                        <table id="table" class=" table table-bordered table-hovered" style="min-width: 100%">
                            <thead>
                                    <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                    </tr>
                            </thead>

                            <tbody>

                                    @foreach ( $users as $index => $item)
                                    <tr>
                                            <td>{{$users->firstItem() + $index}}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>
                                                @if ($item->status == 'approved')
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-danger">Tidak aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                             <div class="d-flex" style="gap: 10px">
                                               @if ($item->status == 'approved')
                                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmationReject-{{ $item->id }}">
                                                            Non-Aktifkan akun
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#confirmationApprove-{{ $item->id }}">
                                                            Aktifkan akun
                                                        </button>

                                                           <form id="delete-form-{{ $item->id }}" action="{{ route('users.destroy', $item->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                                                    <i class="fas fa-eraser"></i>
                                                                </button>
                                                            </form>
                                                    @endif

                                                    </div>
                                            </td>
                                    </tr>
                                    @include('pages.account-list.confirmation-activate')
                                    @include('pages.account-list.confirmation-deactivate')
                                    @endforeach
                            </tbody>
                           </table>
                  </div>
                     </div>

                        @if ($users->hasPages())
                      <div class="card-footer">
                        {{ $users   ->links('pagination::bootstrap-5') }}
                      </div>
                       @endif

                </div>
        </div>
</div>

@endsection

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
