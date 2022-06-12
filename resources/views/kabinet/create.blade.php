@extends('layouts.app')

@section('title', 'Tambah Data Kabinet')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Tambah Kabinet</h4>

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
                <form action="{{ route('kabinet.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama">Nama Kabinet</label>
                        <input class="form-control" type="text" id="nama" name="nama_kabinet" required autofocus>
                        @error('nama_kabinet')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="periode">Periode</label>
                        <input class="form-control" type="text" id="periode" name="periode" required>
                        @error('periode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="target">Target Jumlah Kegiatan</label>
                        <input class="form-control" type="text" id="target" name="target_kegiatan" required>
                        @error('target_kegiatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="logo">Logo</label>
                        <input class="form-control" type="file" id="logo" name="logo" required>
                        @error('logo')
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
