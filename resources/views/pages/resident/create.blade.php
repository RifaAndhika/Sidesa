@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Penduduk</h1>
</div>

{{-- 
@if ($errors->any())

@dd($errors->all())
    
@endif --}}
<div class="row">
    <div class="col">
        <form action="/resident" method="post">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nik">NIK</label>
                        <input type="number" autocomplete="off" inputmode="numeric" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" autocomplete="off" name="name" inputmode="numeric" id="name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="male">Laki-laki</option>
                            <option value="female">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input type="date" name="birth_date"  id="birth_date" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="birth_place">Tempat Lahir</label>
                        <input type="text" name="birth_place" autocomplete="off"  id="birth_place" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="religion">Agama</label>
                        <input type="text" autocomplete="off" name="religion"  id="religion" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="marital_status">Status Perkawinan</label>
                        <select name="marital_status" id="marital_status" class="form-control">
                            <option value="single">Belum Menikah</option>
                            <option value="married">Menikah</option>
                            <option value="divorced">Cerai</option>
                            <option value="widowed">Janda/Duda</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="occupation">Pekerjaan</label>
                        <input type="text" autocomplete="off" name="occupation"  id="occupation" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Telepon</label>
                        <input type="text" autocomplete="off" name="phone" inputmode="numeric"  id="phone" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active">Aktif</option>
                            <option value="moved">Pindah</option>
                            <option value="diceased">Almarhum</option> 
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end" style="gap:10px">
                    <a href="/resident" class="btn btn-outline-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection