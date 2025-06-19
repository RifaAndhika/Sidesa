@extends('layouts.app')

@section('content')

<div class="container-fluid">

   {{-- Cek role pengguna --}}
   @if(auth()->user()->role_id == \App\Models\Role::ROLE_ADMIN)
      {{-- ADMIN DASHBOARD --}}
      <div class="mb-4">
         <h1 class="display-5 text-dark fw-bold">Dashboard Admin</h1>
         <p class="text-muted">Kelola informasi desa dan akun pengguna dari sini.</p>
      </div>

      <div class="row justify-content-center">
         <div class="col-md-10">
            <div class="card shadow border-0 bg-gradient-primary text-white" style="background: linear-gradient(135deg, #1d3557, #457b9d);">
               <div class="card-body">
                  <h3 class="mb-2">👋 Halo, Admin {{ Auth::user()->name }}</h3>
                  <p class="mb-0">
                     Selamat datang di <strong>SIDESA</strong> (Sistem Informasi Desa). Anda memiliki akses penuh untuk memantau aduan, memverifikasi akun, dan mengelola data warga.
                  </p>
               </div>
            </div>
         </div>
      </div>

      <div class="row mt-4 g-4">
         <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 hover-shadow bg-primary text-white">
               <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-comments me-2"></i>Pengaduan Masuk</h5>
                  <p class="card-text">Pantau dan tindak lanjuti laporan dari warga secara real-time.</p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 hover-shadow bg-success text-white">
               <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-users me-2"></i>Data Penduduk</h5>
                  <p class="card-text">Kelola informasi warga desa dengan mudah dan aman.</p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 hover-shadow bg-warning text-white">
               <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-user-check me-2"></i>Permintaan Akun</h5>
                  <p class="card-text">Verifikasi akun baru dan hubungkan dengan data warga.</p>
               </div>
            </div>
         </div>
         <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm border-0 h-100 hover-shadow bg-dark text-white">
               <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-user-cog me-2"></i>Daftar Akun</h5>
                  <p class="card-text">Aktifkan atau nonaktifkan akun pengguna sesuai kebutuhan.</p>
               </div>
            </div>
         </div>
      </div>

   @else
      {{-- USER DASHBOARD --}}
      <div class="mb-4">
         <h1 class="display-5 text-dark fw-bold">Dashboard Warga</h1>
         <p class="text-muted">Akses pengaduan Anda dan lihat riwayat laporan.</p>
      </div>

      <div class="row justify-content-center">
         <div class="col-md-10">
            <div class="card shadow border-0 bg-gradient-info text-white" style="background: linear-gradient(135deg, #00b4d8, #0077b6);">
               <div class="card-body">
                  <h3 class="mb-2">👋 Halo, {{ Auth::user()->name }}</h3>
                  <p class="mb-0">Selamat datang di <strong>SIDESA</strong>. Gunakan fitur pengaduan untuk menyampaikan keluhan di lingkungan desa Anda.</p>
               </div>
            </div>
         </div>
      </div>

      <div class="row mt-4 g-4">
         <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 hover-shadow bg-info text-white">
               <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-edit me-2"></i>Buat Pengaduan</h5>
                  <p class="card-text">Sampaikan pengaduan secara online tanpa harus datang ke kantor desa.</p>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 hover-shadow bg-secondary text-white">
               <div class="card-body">
                  <h5 class="card-title"><i class="fas fa-history me-2"></i>Riwayat Pengaduan</h5>
                  <p class="card-text">Lihat daftar dan status pengaduan yang telah Anda kirim.</p>
               </div>
            </div>
         </div>
      </div>
   @endif

</div>

<style>
   body {
      background-color: #f8f9fc;
   }
   .hover-shadow:hover {
      transform: translateY(-4px);
      transition: all 0.3s ease;
   }
</style>

@endsection
