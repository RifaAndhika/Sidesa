@extends('layouts.app')

@section('content')

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Daftar Akun Penduduk</h1>
</div>

@if (session('success'))
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{{ session()->get('success') }}",
        icon: "succes"
    });
</script>
@endif


<div class="row">
        <div class="col">
                <div class="card shadow">
                      <div class="card-body">
                     <div style="overflow-x: auto;">
                        <table class=" table table-bordered table-hovered" style="min-width: 100%">
                            <thead>
                                    <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                    </tr>
                            </thead>
                            @if (count($users) < 1)
                                    <tbody>
                                            <tr>
                                                    <td colspan="11">
                                                             <p class=" pt-3 text-center">Tidak ada data</p>
                                                    </td>
                                            </tr>
                                    </tbody>
                            @else
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
                                                <button  type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmationReject-{{ $item->id }}">
                                                    Non-Aktifkan akun
                                                        </button>
                                            @else
                                            <button  type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#confirmationApprove-{{ $item->id }}">
                                                    Aktifkan akun
                                                    </button>
                                            @endif
                                                    </div>
                                            </td>
                                    </tr>
                                    @include('pages.account-list.confirmation-activate')
                                    @include('pages.account-list.confirmation-deactivate')
                                    @endforeach
                            </tbody>
                            @endif
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
