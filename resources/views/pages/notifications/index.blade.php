@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800">Semua Notifikasi</h1>
</div>

<div class="row">
    <div class="col-12">
        <!-- Notifikasi Card -->
        <div class="card shadow mb-4">
            <div class="card-body">
                @forelse (auth()->user()->notifications as $notification)
                    <div class="d-flex align-items-start justify-content-between p-3 mb-2 border rounded
                        {{ is_null($notification->read_at) ? 'bg-light' : 'bg-white' }}">

                        <div class="d-flex">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary text-white p-2 rounded-circle">
                                    <i class="fas fa-bell"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-muted">
                                    {{ $notification->created_at->diffForHumans() }}
                                    @if(is_null($notification->read_at))
                                        <span class="badge badge-pill badge-danger ml-2">Baru</span>
                                    @endif
                                </div>
                                <div class="font-weight-normal {{ is_null($notification->read_at) ? 'font-weight-bold' : 'text-muted' }}">
                                    {{ $notification->data['message'] ?? 'Notifikasi tanpa pesan.' }}
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Tandai Dibaca --}}
                        @if(is_null($notification->read_at))
                            <form action="{{ url('notification/'.$notification->id.'/read') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="btn btn-sm btn-outline-success">Tandai Dibaca</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-muted">Tidak ada notifikasi.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
