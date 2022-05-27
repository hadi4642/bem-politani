@extends('layouts.app')

@section('title', 'Tambah Data Kegiatan')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Tambah Kegiatan</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Kegiatan</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input class="form-control" type="text" id="nama_kegiatan" name="nama_kegiatan" required autofocus>
                        @error('nama_kegiatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tema_kegiatan">Tema Kegiatan</label>
                        <input class="form-control" type="text" id="tema_kegiatan" name="tema_kegiatan" required>
                        @error('tema_kegiatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input class="form-control" type="date" id="tanggal" name="tanggal" required>
                        @error('tanggal')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="waktu">Waktu</label>
                        <input class="form-control" type="time" id="waktu" name="waktu" required>
                        @error('waktu')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempat">Tempat</label>
                        <input class="form-control" type="text" id="tempat" name="tempat" required>
                        @error('tempat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="elm1">Struktur Panitia</label>
                        <textarea id="elm1" name="struktur_panitia"></textarea>
                        @error('struktur_panitia')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input class="form-control" type="number" id="jumlah_peserta" name="jumlah_peserta" required>
                        @error('jumlah_peserta')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dana_masuk">Dana Masuk</label>
                        <input class="form-control" type="number" id="dana_masuk" name="dana_masuk" required>
                        @error('dana_masuk')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dana_keluar">Dana Keluar</label>
                        <input class="form-control" type="number" id="dana_keluar" name="dana_keluar" required>
                        @error('dana_keluar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dokumentasi_nota">Dokumentasi Nota</label>
                        <input class="form-control" type="file" id="dokumentasi_nota" name="dokumentasi_nota[]" multiple>
                        @error('dokumentasi_nota')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dokumentasi_kegiatan">Dokumentasi Kegiatan</label>
                        <input class="form-control" type="file" id="dokumentasi_kegiatan" name="dokumentasi_kegiatan[]" multiple>
                        @error('dokumentasi_kegiatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!--tinymce js-->
<script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>

<!-- init js -->
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
@endpush
