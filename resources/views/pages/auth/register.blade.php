<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Sidesa</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap & SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #4e73df, #224abe);
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #4e73df;
        }
        .input-group-text {
            background-color: #e9ecef;
        }
        .invalid-feedback {
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

<div class="container py-5 animate__animated animate__fadeInUp animate__delay-0.5s">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card p-4">
                <h3 class="text-center text-primary mb-4">Daftar Akun Sidesa</h3>

                <form action="/register" method="POST" enctype="multipart/form-data" onsubmit="disableSubmitBtn()">
    @csrf
    <div class="form-row">

        <!-- Nama Lengkap -->
        <div class="form-group col-md-6">
            <label>Nama Lengkap</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Email -->
        <div class="form-group col-md-6">
            <label>Email</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="Email" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Password -->
        <div class="form-group col-md-6">
            <label>Password</label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Minimal 8 karakter" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group col-md-6">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password" required>
        </div>

        <!-- NIK -->
        <div class="form-group col-md-6">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                   value="{{ old('nik') }}" placeholder="Contoh: 1234567890123456" required>
            @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-group col-md-6">
            <label>Jenis Kelamin</label>
            <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                <option value="">-- Pilih --</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Tempat Lahir -->
        <div class="form-group col-md-6">
            <label>Tempat Lahir</label>
            <input type="text" name="birth_place" class="form-control @error('birth_place') is-invalid @enderror"
                   value="{{ old('birth_place') }}" required>
            @error('birth_place') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Tanggal Lahir -->
        <div class="form-group col-md-6">
            <label>Tanggal Lahir</label>
            <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
                   value="{{ old('birth_date') }}" required>
            @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Alamat -->
        <div class="form-group col-md-12">
            <label>Alamat</label>
            <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                      rows="2" required>{{ old('address') }}</textarea>
            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Status Perkawinan -->
        <div class="form-group col-md-6">
            <label>Status Perkawinan</label>
            <select name="marital_status" class="form-control @error('marital_status') is-invalid @enderror" required>
                <option value="">-- Pilih --</option>
                <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Kawin</option>
                <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Cerai</option>
                <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Janda/Duda</option>
            </select>
            @error('marital_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Agama -->
        <div class="form-group col-md-6">
            <label>Agama</label>
            <select name="religion" class="form-control @error('religion') is-invalid @enderror" required>
                <option value="">-- Pilih --</option>
                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
            @error('religion') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Pekerjaan -->
        <div class="form-group col-md-6">
            <label>Pekerjaan</label>
            <input type="text" name="occupation" class="form-control @error('occupation') is-invalid @enderror"
                   value="{{ old('occupation') }}" required>
            @error('occupation') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Nomor Telepon -->
        <div class="form-group col-md-6">
            <label>Nomor Telepon</label>
            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone') }}" placeholder="Contoh: 081234567890" required>
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <!-- Upload KTP -->
        <div class="form-group col-md-12">
            <label for="ktp_file" class="font-weight-bold">Upload Foto KTP</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('ktp_file') is-invalid @enderror"
                       id="ktp_file" name="ktp_file" required>
                <label class="custom-file-label" for="ktp_file">Pilih file...</label>
                @error('ktp_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Submit -->
        <div class="form-group col-md-12 mt-3">
            <button id="submitBtn" type="submit" class="btn btn-primary btn-block">Simpan</button>
        </div>
    </div>
</form>


                <div class="text-center mt-3">
                    <a class="small" href="/">Kembali</a> | <a class="small" href="/login">Sudah punya akun? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS dependencies -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function disableSubmitBtn() {
        const btn = document.getElementById("submitBtn");
        btn.disabled = true;
        btn.textContent = "Loading...";
    }

    // Show filename in custom file input
    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split("\\").pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Example error alert (if errors exist)
    // Simulasi Error
    const showError = false;
    if (showError) {
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            html: 'Silakan periksa kembali input Anda.',
        });
    }
</script>

</body>

</html>
