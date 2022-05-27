@extends('layouts.app')

@section('title', 'Edit Data Anggota')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Anggota</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Master</a></li>
                    <li class="breadcrumb-item active">Anggota</li>
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
                <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nim">NIM</label>
                        <input class="form-control" type="text" id="nim" name="nim" required autofocus value="{{ $anggota->nim }}">
                        @error('nim')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" id="nama" name="nama" required value="{{ $anggota->nama }}">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                id="laki-laki" value="Laki-Laki" {{ $anggota->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }}>
                            <label class="form-check-label" for="laki-laki">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                id="perempuan" value="Perempuan" {{ $anggota->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                            <label class="form-check-label" for="perempuan">
                                Perempuan
                            </label>
                        </div>
                        @error('jenis_kelamin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telp">No. Telepon</label>
                        <input class="form-control" type="number" id="no_telp" name="no_telp" required value="{{ $anggota->no_telp }}">
                        @error('no_telp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email" required value="{{ $anggota->email }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="prodi">Prodi</label>
                        <select class="form-control" id="prodi" name="prodi_id">
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $anggota->prodi_id ? 'selected' : '' }}>{{ $item->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_angkatan">Tahun Angkatan</label>
                        <input class="form-control" type="number" id="tahun_angkatan" name="tahun_angkatan" required value="{{ $anggota->tahun_angkatan }}">
                        @error('tahun_angkatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="divisi">Divisi</label>
                        <select class="form-control" id="divisi" name="divisi_id">
                            @foreach ($divisi as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $anggota->divisi_id ? 'selected' : '' }}>{{ $item->nama_divisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label><span class="text-danger" style="font-size: 10px;"><i> *Kosongkan kolom jika tidak ingin merubah password</i></span>
                        <input class="form-control" type="password" id="password" name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="Admin" {{ $anggota->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="User" {{ $anggota->role == 'User' ? 'selected' : '' }}>User</option>
                        </select>
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
