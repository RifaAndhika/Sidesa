@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Aduan Warga' : 'Aduan' }}</h1>
    @if($resident)
        <a href="/complaint/create" class="btn btn-primary">Buat Aduan +</a>
    @else
    @endif
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if (session('resident_warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Perhatian!',
            text: '{{ session('resident_warning') }}',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover w-100" id="complaintsTable" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">No</th>
                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <th>Nama</th>
                                @endif
                                <th style="width: 15%">Judul</th>
                                <th style="width: 25%">Isi Aduan</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Foto Bukti</th>
                                <th style="width: 15%">Tanggal Laporan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        @if ($complaint->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach ($complaint as $index => $item)
                            <tr>
                                <td>{{ $complaint->firstItem() + $index }}</td>
                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <td>{{ $item->resident->name }}</td>
                                @endif
                                <td>{{ $item->title }}</td>
                                <td>{!! nl2br(e(wordwrap($item->content, 100))) !!}</td>

                                <td>
                                    @php
                                        $statusColors = [
                                            'new' => 'primary',       // kuning
                                            'processing' => 'warning', // hijau
                                            'completed' => 'success', // biru
                                        ];
                                        $statusLabels = [
                                            'new' => 'Baru',
                                            'processing' => 'Diproses',
                                            'completed' => 'Selesai',
                                        ];
                                        $color = $statusColors[$item->status] ?? 'secondary';
                                        $label = $statusLabels[$item->status] ?? ucfirst($item->status);
                                    @endphp

                                    <span class="btn btn-{{ $color }} btn-sm disabled" style="pointer-events: none;">
                                        {{ $label }}
                                    </span>
                                </td>

                                <td>
                                    @if ($item->photo_proof)
                                        @php
                                            $filePath = 'storage/' . $item->photo_proof;
                                        @endphp
                                        <a href="{{ asset($filePath) }}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ asset($filePath) }}" alt="Foto Bukti" class="img-thumbnail" style="width: 150px; height: 100px; object-fit: cover;"></img>
                                        </a>
                                    @else
                                        Tidak Ada
                                    @endif
                                </td>
                                <td>{{ $item->report_data_label }}</td>
                                <td>
                                      @if ($item->can_edit_delete)
                                        <div class="d-flex justify-content-center" style="gap: 5px">
                                            <a href="/complaint/{{ $item->id }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                                <i class="fas fa-eraser"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @elseif (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                    <div class="">
                                       <form action="{{ url('complaint/update-status/' . $item->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <select name="status" class="form-control" style="min-width: 150px" onchange="this.form.submit()">
                                                @foreach ([
                                                    (object)['label' => 'Baru', 'value' => 'new'],
                                                    (object)['label' => 'Sedang Diproses', 'value' => 'processing'],
                                                    (object)['label' => 'Selesai', 'value' => 'completed'],
                                                ] as $status)
                                                    <option value="{{ $status->value }}" @selected($item->status == $status->value)>
                                                        {{ $status->label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @include('pages.complaints.confirmation-delete')
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>

            @if ($complaint->hasPages())
            <div class="card-footer">
                {{ $complaint->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>

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



@endsection
