<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login SiDesa</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <!-- Custom Style -->
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Nunito', sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(to right, #3b66c2, #597be9);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-card {
      background-color: white;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-card h1 {
      text-align: center;
      margin-bottom: 24px;
      font-size: 22px;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 25px;
      outline: none;
    }

    button[type="submit"] {
      width: 100%;
      padding: 12px;
      background-color: #4e73df;
      border: none;
      color: white;
      border-radius: 25px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #3756c0;
    }

    .text-center {
      text-align: center;
      margin-top: 20px;
    }

    .text-center a {
      color: #4e73df;
      text-decoration: none;
      font-size: 14px;
    }

    .text-center a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  @if ($errors->any())
  <script>
    Swal.fire({
      title: "Terjadi Kesalahan!",
      text: "@foreach ($errors->all() as $error) {{ $error }}{{ $loop->last ? '.' : ',' }} @endforeach",
      icon: "error"
    });
  </script>
  @endif

  <div class="login-card animate__animated animate__fadeInUp animate__delay-0.5s">
    <h1>Masuk SiDesa</h1>
    <form action="/login" method="POST" onsubmit="document.getElementById('submitBtn').disabled = true; document.getElementById('submitBtn').textContent = 'Loading...';">
      @csrf
      @method('POST')

      <div class="form-group">
        <input type="email" name="email" placeholder="Enter Email Address..." autocomplete="off" required />
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" autocomplete="off" required />
      </div>
      <button type="submit" id="submitBtn">Login</button>
    </form>
    <div class="text-center">
      <a href="/">Kembali</a> || <a href="{{ route('register') }}">buat akun baru!</a>
    </div>
  </div>

  @if(session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '{{ session('success') }}',
      timer: 3000,
      showConfirmButton: false
    });
  </script>
  @endif

</body>

</html>
