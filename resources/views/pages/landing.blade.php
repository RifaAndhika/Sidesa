<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aplikasi Pengaduan Masyarakat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- AOS Library -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow fixed w-full z-50">
  <div class="max-w-7xl mx-auto px-4 py-4 flex flex-wrap justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">Pengaduan Masyarakat</h1>
    <div class="flex flex-wrap gap-3 mt-3 sm:mt-0">
      <a href="{{ url('/login') }}" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-full hover:bg-blue-50 transition text-sm">Login</a>
      <a href="{{ url('/register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition text-sm">Daftar</a>
    </div>
  </div>
</nav>

  <!-- Hero Section -->
  <section class="text-center py-32 bg-gradient-to-r from-blue-600 to-cyan-400 text-white relative overflow-hidden">
    <div class="container mx-auto px-4" data-aos="fade-up">
      <h2 class="text-5xl font-bold mb-4">Laporkan Masalah Sekitar Anda</h2>
      <p class="text-lg max-w-2xl mx-auto mb-6">Kami hadir untuk membantu menyampaikan aspirasi dan pengaduan masyarakat secara mudah, cepat, dan transparan.</p>
      <a href="{{ url('/register') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transition">Mulai Lapor</a>
    </div>
  </section>

  <!-- Fitur Section -->
  <section class="py-20 bg-gray-100">
    <div class="container mx-auto px-4">
      <h3 class="text-3xl font-bold text-center text-blue-700 mb-12" data-aos="fade-down">Fitur Unggulan</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="100">
          <img src="https://img.icons8.com/color/96/report-card.png" class="mx-auto mb-4" alt="Pengaduan Mudah" />
          <h4 class="text-xl font-semibold mb-2">Pengaduan Mudah</h4>
          <p>Laporkan masalah Anda hanya dalam beberapa langkah melalui antarmuka yang sederhana.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="200">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>
          <h4 class="text-xl font-semibold mb-2">Notifikasi Real-Time</h4>
          <p>Dapatkan informasi dan update status pengaduan Anda secara langsung melalui sistem kami.</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="300">
          <img src="https://img.icons8.com/color/96/admin-settings-male.png" class="mx-auto mb-4" alt="Manajemen Admin" />
          <h4 class="text-xl font-semibold mb-2">Manajemen Admin</h4>
          <p>Tim admin siap menangani laporan dengan efisien dan akurat melalui dashboard admin yang lengkap.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Tentang Pengembang -->
  <section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-4xl text-center" data-aos="fade-up">
      <h3 class="text-3xl font-bold text-blue-700 mb-6">Tentang Pengembang</h3>
      <p class="text-lg mb-4">Halo! Kami <strong>Kelompok 6</strong>, mahasiswa <strong>Teknik Informatika</strong> semester 2. Aplikasi ini adalah bagian dari pembelajaran kami dalam mata kuliah <strong>Pemrograman Web</strong>.</p>
      <p class="text-lg">Tujuan kami adalah membangun portofolio yang berdampak dan bermanfaat bagi masyarakat luas, khususnya dalam dunia IT dan digitalisasi layanan publik.</p>
    </div>
  </section>

  <!-- CTA -->
  <section class="bg-blue-600 text-white text-center py-20" data-aos="fade-in">
    <h3 class="text-3xl font-bold mb-4">Siap Membantu Masyarakat</h3>
    <p class="mb-6">Gabung sekarang dan mulai suarakan aspirasi Anda.</p>
    <a href="{{ url('/register') }}" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transition">Daftar Sekarang</a>
  </section>

  <!-- Footer -->
  <footer class="text-center py-6 text-sm text-gray-500 bg-gray-100" data-aos="fade-up">
    &copy; {{ date('Y') }} - Dibuat dengan ❤️ oleh Kelompok 6
  </footer>

  <script>
    AOS.init({
      once: true,
      duration: 1000,
      easing: 'ease-in-out'
    });
  </script>
</body>
</html>
