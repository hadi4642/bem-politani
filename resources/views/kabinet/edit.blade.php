@extends('layouts.app')

@section('title', 'Edit Data Kabinet')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Kabinet</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Kabinet</li>
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
                <form action="{{ route('kabinet.update', $kabinet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama">Nama Kabinet</label>
                        <input class="form-control" type="text" id="nama" name="nama_kabinet" required autofocus value="{{ $kabinet->nama_kabinet }}">
                        @error('nama_kabinet')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="periode">Periode</label>
                        <input class="form-control" type="text" id="periode" name="periode" required value="{{ $kabinet->periode }}">
                        @error('periode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="target">Target Jumlah Kegiatan</label>
                        <input class="form-control" type="text" id="target" name="target_kegiatan" required value="{{ $kabinet->target_kegiatan }}">
                        @error('target_kegiatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="logo">Logo</label>
                        <input class="form-control" type="file" id="logo" name="logo">
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
