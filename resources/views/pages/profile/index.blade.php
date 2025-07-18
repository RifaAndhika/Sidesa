@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil Saya</h1>
</div>

@if (session('success'))
<script>
    Swal.fire({
        title: "Berhasil!",
        text: "{{ session('success') }}",
        icon: "success"
    });
</script>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col">
        <form action="/profile/{{ auth()->user()->id }}" method="post">
            @csrf

                @if (auth()->user()->role_id == \App\Models\Role::ROLE_USER)

                   <div class="mb-3 text-center">
                            <label class="d-block mb-2"><strong>Foto KTP:</strong></label>
                          <img
                                src="{{ asset('storage/' . auth()->user()->resident->ktp_file) }}"
                                alt="Foto KTP"
                                class="img-thumbnail shadow-sm"
                                style="width: 100%; max-width: 600px; max-height: 450px; object-fit: contain;"
                            >

                        </div>

                @endif

            <div class="card">
                <div class="card-body">
                    {{-- Nama --}}
                    <div class="form-group mb-3">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', auth()->user()->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Email readonly --}}
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" readonly
                               value="{{ auth()->user()->email }}">
                    </div>

                    @if(auth()->user()->role_id == \App\Models\Role::ROLE_USER)
                        {{-- Field hanya untuk USER --}}
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control"
                                   value="{{ old('nik', auth()->user()->resident->nik ?? '') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="male" {{ (auth()->user()->resident->gender ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ (auth()->user()->resident->gender ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>

                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="birth_place">Tempat Lahir</label>
                            <input type="text" name="birth_place" id="birth_place" class="form-control"
                                   value="{{ old('birth_place', auth()->user()->resident->birth_place ?? '') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="birth_date">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control"
                                   value="{{ old('birth_date', auth()->user()->resident->birth_date ?? '') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" class="form-control">{{ old('address', auth()->user()->resident->address ?? '') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="religion">Agama</label>
                            <input type="text" name="religion" id="religion" class="form-control"
                                   value="{{ old('religion', auth()->user()->resident->religion ?? '') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="marital_status">Status Pernikahan</label>
                            <select name="marital_status" id="marital_status" class="form-control">
                               <option value="single" {{ (auth()->user()->resident->marital_status ?? '') == 'single' ? 'selected' : '' }}>Belum Menikah</option>
                                <option value="married" {{ (auth()->user()->resident->marital_status ?? '') == 'married' ? 'selected' : '' }}>Menikah</option>
                                <option value="divorced" {{ (auth()->user()->resident->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>Cerai</option>
                                <option value="widowed" {{ (auth()->user()->resident->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>Duda/Janda</option>

                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="occupation">Pekerjaan</label>
                            <input type="text" name="occupation" id="occupation" class="form-control"
                                   value="{{ old('occupation', auth()->user()->resident->occupation ?? '') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">No. HP</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                   value="{{ old('phone', auth()->user()->resident->phone ?? '') }}">
                        </div>

                    @endif

                </div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="/dashboard" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
