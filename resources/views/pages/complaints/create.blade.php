@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Buat Aduan</h1>
</div>

{{--
@if ($errors->any())

@dd($errors->all())

@endif --}}
<div class="row">
    <div class="col">
        <form action="/complaint" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-body">
               <div class="form-group mb-3">
                    <label for="category">Kategori</label>
                    <select name="category" id="category" class="form-control @error('category') is-invalid @enderror"
                       value="{{ old('category') }}">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="infrastruktur" {{ old('category') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                        <option value="kebersihan" {{ old('category') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                        <option value="keamanan" {{ old('category') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                        <option value="sosial" {{ old('category') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                        <option value="kesehatan" {{ old('category') == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    </select>
                     @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                    <div class="form-group mb-3">
                        <label for="title">Judul <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" maxlength="16" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                     <div class="form-group mb-3">
                        <label for="content">Isi Aduan <span class="text-danger">*</span></label>
                        <textarea name="content" id="content" cols="30" rows="10"
                            class="form-control @error('content') is-invalid @enderror">
                            {{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="photo_proof">Bukti Foto <span class="text-danger">*</span></label>
                        <input type="file" name="photo_proof" id="photo_proof"
                            class="form-control @error('photo_proof') is-invalid @enderror">
                        @error('photo_proof')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end" style="gap:10px">
                    <a href="/complaint" class="btn btn-outline-secondary">
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
