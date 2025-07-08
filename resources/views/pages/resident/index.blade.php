@extends('layouts.app')

@section('title', 'Data Penduduk')

@section('content')

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Data Penduduk</h1>
    {{-- <a href="/resident/create" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
    </a> --}}
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered table-hover align-middle" style="width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>Agama</th>
                                <th>Status Kawin</th>
                                <th>Pekerjaan</th>
                                <th>Telepon</th>
                                <th style="min-width: 120px;">Akun Terhubung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($residents as $index => $item)
                            <tr>
                                <td>{{ $residents->firstItem() + $index }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                                <td>{{ $item->gender_label }}</td>
                                <td>{{ $item->birth_place }}, {{ $item->birth_date }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->religion }}</td>
                                <td>{{ $item->marital_status_label }}</td>
                                <td>{{ $item->occupation }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2 flex-nowrap">
                                        {{-- <a href="/resident/{{ $item->id }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                          <form id="delete-form-{{ $item->id }}" action="{{ route('resident.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="fas fa-eraser"></i>
                                                </button>
                                            </form> --}}
                                        @if (!is_null($item->user_id))
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailAccount-{{ $item->id }}">
                                            <i class="fas fa-user"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @include('pages.resident.confirmation-delete')
                            @include('pages.resident.detail-account')
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($residents->hasPages())
            <div class="card-footer">
                {{ $residents->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
{{--
@section('scripts')
<script>
    // SweetAlert untuk sukses tambah/edit
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif

    // SweetAlert untuk error
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            timer: 2500,
            showConfirmButton: false
        });
    @endif
</script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang dihapus tidak bisa dikembalikan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

@endsection --}}

@endsection
