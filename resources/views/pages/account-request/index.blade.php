@extends('layouts.app')

@section('title', 'Permintaan Akun')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Permintaan Akun</h1>
</div>

@if (session('success'))
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{{ session()->get('success') }}",
        icon: "success"
    });
</script>
@endif

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table id="table" class="table table-bordered table-hovered" style="min-width: 100%">
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
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <div class="d-flex" style="gap: 10px">
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationReject-{{ $item->id }}">
                                            Tolak
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmationApprove-{{ $item->id }}">
                                            Setuju
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.account-request.confirmation-reject')
                            @include('pages.account-request.confirmation-approve')

                           @empty
                            <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                            </tr>
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
    </div>
</div>



@endsection
