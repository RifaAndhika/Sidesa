<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-600">Aplikasi Pengaduan Masyarakat</h1>
            <div class="space-x-2">
                <a href="{{ url('/login') }}" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-full hover:bg-blue-50 transition">Login</a>
                <a href="{{ url('/register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-16 bg-gradient-to-r from-blue-600 to-teal-400 text-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold mb-4 animate-fadeInDown">Selamat Datang 👋</h2>
            <p class="text-lg max-w-xl mx-auto animate-fadeInUp delay-100">Ini adalah aplikasi pengaduan masyarakat berbasis Laravel. Buatan Mahasiswa TI yang sedang belajar dan membangun portofolio.</p>
        </div>
    </section>

    <!-- About Me -->
    <section class="py-12">
        <div class="container mx-auto px-4 max-w-3xl">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-semibold mb-4 text-blue-700">Tentang Saya</h3>
                <p class="mb-3">Halo! Saya <strong>[Rifa Andhika]</strong>, mahasiswa <strong>Teknik Informatika</strong> semester 2. Saya tertarik di bidang <strong>Web Development, Teknologi, dan Investasi</strong>.</p>
                <p class="mb-3">Aplikasi ini merupakan latihan Laravel yang saya kembangkan dengan fitur-fitur seperti autentikasi, pengaduan masyarakat, notifikasi, dan manajemen user/admin.</p>
                <p>Saya sedang membangun portofolio untuk karier saya ke depan di dunia IT dan bisnis digital.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-sm text-gray-500">
        &copy; {{ date('Y') }} - Dibuat dengan ❤️ oleh [Rifa Andhika]
    </footer>

    <!-- Animasi sederhana -->
    <style>
        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .animate-fadeInDown {
            animation: fadeInDown 0.6s ease-out;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }
    </style>

</body>
</html>
