@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Aduan</h1>
</div>

{{--
@if ($errors->any())

@dd($errors->all())

@endif --}}
<div class="row">
    <div class="col">
         <form action="{{ route('complaint.update', $complaint->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="category">Kategori</label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="infrastruktur" {{ old('category', $complaint->category) == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                            <option value="kebersihan" {{ old('category', $complaint->category) == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                            <option value="keamanan" {{ old('category', $complaint->category) == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                            <option value="sosial" {{ old('category', $complaint->category) == 'sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="kesehatan" {{ old('category', $complaint->category) == 'kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        </select>
                        @error('category')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group mb-3">
                        <label for="title">Judul</label>
                        <input type="text" autocomplete="off" maxlength="16" name="title" id="title" class="form-control
                         @error('title') is-invalid @enderror" value="{{ old('title' , $complaint->title) }}">
                        @error('title')
                            <span class="is-invalid">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                       <div class="form-group mb-3">
                        <label for="content">Isi Aduan</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control
                        @error('content') is-invalid @enderror">{{ old('content', $complaint->content) }}</textarea>
                        @error('content')
                        <span class="invalid-feedback"
                            {{ $message }}
                        </span>
                    @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="photo_proof">Bukti Foto</label>
                        <input type="file" autocomplete="off" name="photo_proof" inputmode="numeric" id="photo_proof" class="form-control
                        @error('photo_proof') is-invalid @enderror" value="{{ old('photo_proof') }}">
                        @error('photo_proof')
                        <span class="is-invalid">
                            {{ $message }}
                        </span>
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
