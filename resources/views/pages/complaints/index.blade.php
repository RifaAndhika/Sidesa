@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN ? 'Aduan Warga' : 'Aduan' }}</h1>
    @if($resident)
        <a href="/complaint/create" class="btn btn-primary">Buat Aduan +</a>
    @else
    @endif
</div>

@if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
<form action="{{ route('complaint.index') }}" method="GET" class="mb-3">
    <div class="row g-2 align-items-center">

        <!-- Filter Kategori -->
        <div class="col-md-4 col-sm-6">
            <label for="filter_category" class="form-label">Filter Kategori:</label>
            <select name="category" id="filter_category" class="form-control" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <option value="infrastruktur" {{ request('category') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                <option value="kebersihan" {{ request('category') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                <option value="keamanan" {{ request('category') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                <option value="sosial" {{ request('category') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                <option value="kesehatan" {{ request('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
            </select>
        </div>

        <!-- Filter Status -->
        <div class="col-md-4 col-sm-6">
            <label for="filter_status" class="form-label">Filter Status:</label>
            <select name="status" id="filter_status" class="form-control" onchange="this.form.submit()">
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Baru</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

    </div>
</form>
@endif


<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered table-hover w-100" id="complaintsTable" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%">No</th>

                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <th>Nama</th>
                                @endif
                                <th style="width: 10%">Kategori</th>
                                <th style="width: 15%">Judul</th>
                                <th style="width: 25%">Isi Aduan</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 20%">Foto Bukti</th>
                                <th style="width: 15%">Tanggal Laporan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>



                        <tbody>
                            @foreach ($complaint as $index => $item)
                            <tr>
                                <td>{{ $complaint->firstItem() + $index }}</td>


                                @if (auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
                                <td>{{ $item->resident->name }}</td>
                                @endif

                            <td>
                                @php
                                    $categoryBadges = [
                                        'infrastruktur' => 'secondary',
                                        'kebersihan' => 'success',
                                        'keamanan' => 'warning',
                                        'sosial' => 'info',
                                        'kesehatan' => 'danger',
                                    ];
                                    $badge = $categoryBadges[$item->category] ?? 'dark';
                                @endphp
                                <span class="badge bg-{{ $badge }}">
                                    {{ ucfirst($item->category) }}
                                </span>
                            </td>

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

    @if (session('resident_warning'))

            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: '{{ session('resident_warning') }}',
                timer: 3000,
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
