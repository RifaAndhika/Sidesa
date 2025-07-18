@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

   @php
      $isAdmin = auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN;
   @endphp

   {{-- Header --}}
   <div class="mb-5 text-center" data-aos="fade-down">
      <h1 class="display-5 fw-bold text-primary">
         {{ $isAdmin ? 'Dashboard Admin' : 'Dashboard Warga' }}
      </h1>
      <p class="text-muted fs-5">
         {{ $isAdmin
            ? 'Kelola informasi desa dan akun pengguna dari sini.'
            : 'Akses pengaduan Anda dan lihat riwayat laporan.'
         }}
      </p>
   </div>

   {{-- Welcome Card --}}
   <div class="row justify-content-center mb-5" data-aos="zoom-in">
      <div class="col-md-10">
         <div class="card border-0 text-white rounded-4 shadow-lg"
              style="background: linear-gradient(135deg, {{ $isAdmin ? '#1d3557, #457b9d' : '#00b4d8, #0077b6' }});">
            <div class="card-body p-4">
               <h3 class="mb-2">👋 Halo, {{ auth()->user()->name }}</h3>
               <p class="mb-0">
                  Selamat datang di <strong>SIDESA</strong>.
                  {{ $isAdmin
                     ? 'Anda memiliki akses penuh untuk memantau aduan, memverifikasi akun, dan mengelola data warga.'
                     : 'Gunakan fitur pengaduan untuk menyampaikan keluhan di lingkungan desa Anda.' }}
               </p>
            </div>
         </div>
      </div>
   </div>

   {{-- Dashboard Cards --}}
   <div class="row g-4">
      @if($isAdmin)
         @php
            $adminCards = [
               ['title' => 'Pengaduan Masuk', 'desc' => 'Pantau laporan warga secara real-time.', 'icon' => 'fa-comments', 'bg' => 'primary', 'delay' => 100],
               ['title' => 'Data Penduduk', 'desc' => 'Kelola informasi warga dengan aman.', 'icon' => 'fa-users', 'bg' => 'success', 'delay' => 200],
               ['title' => 'Permintaan Akun', 'desc' => 'Verifikasi akun baru dari warga.', 'icon' => 'fa-user-check', 'bg' => 'warning', 'delay' => 300],
               ['title' => 'Daftar Akun', 'desc' => 'Aktifkan/nonaktifkan pengguna.', 'icon' => 'fa-user-cog', 'bg' => 'dark', 'delay' => 400],
            ];
         @endphp
         @foreach($adminCards as $card)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $card['delay'] }}">
               <div class="card shadow-sm border-0 h-100 hover-shadow bg-{{ $card['bg'] }} text-white rounded-4">
                  <div class="card-body d-flex flex-column justify-content-center">
                     <div class="mb-3 text-center fs-2"><i class="fas {{ $card['icon'] }}"></i></div>
                     <h5 class="card-title text-center">{{ $card['title'] }}</h5>
                     <p class="card-text text-center">{{ $card['desc'] }}</p>
                  </div>
               </div>
            </div>
         @endforeach
      @else
         @php
            $userCards = [
               ['title' => 'Buat Pengaduan', 'desc' => 'Laporkan masalah tanpa datang ke kantor desa.', 'icon' => 'fa-edit', 'bg' => 'info', 'delay' => 100],
               ['title' => 'Riwayat Pengaduan', 'desc' => 'Lihat status dan riwayat laporan Anda.', 'icon' => 'fa-history', 'bg' => 'secondary', 'delay' => 200],
            ];
         @endphp
         @foreach($userCards as $card)
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $card['delay'] }}">
               <div class="card shadow-sm border-0 h-100 hover-shadow bg-{{ $card['bg'] }} text-white rounded-4">
                  <div class="card-body d-flex flex-column justify-content-center">
                     <div class="mb-3 text-center fs-2"><i class="fas {{ $card['icon'] }}"></i></div>
                     <h5 class="card-title text-center">{{ $card['title'] }}</h5>
                     <p class="card-text text-center">{{ $card['desc'] }}</p>
                  </div>
               </div>
            </div>
         @endforeach
      @endif
   </div>

</div>

{{-- Custom Styling --}}
<style>
   body {
      background-color: #f4f6fa;
   }
   .hover-shadow:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
      transition: all 0.35s ease;
   }
</style>
@endsection



