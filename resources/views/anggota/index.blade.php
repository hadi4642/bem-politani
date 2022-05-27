@extends('layouts.app')

@section('title', 'Data Anggota')

@push('styles')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Data Anggota</h4>

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
                    @if (Auth::user()->role == 'Admin')
                    <a href="{{ route('anggota.create') }}" class="btn btn-primary waves-effect waves-light mb-3"> Tambah Anggota</a>
                    @endif
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>No. Telepon</th>
                                    <th>Prodi</th>
                                    <th>Angkatan</th>
                                    <th>Divisi</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nim }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->no_telp }}</td>
                                        <td>{{ $item->prodi->nama_prodi }}</td>
                                        <td>{{ $item->tahun_angkatan }}</td>
                                        <td>{{ $item->divisi->nama_divisi }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            @if (Auth::user()->role == 'Admin')
                                            <a href="{{ route('anggota.edit', $item->id) }}" class="btn btn-sm btn-warning waves-effect waves-light">Edit</a>
                                            {{-- Cegah user menghapus dirinya sendiri --}}
                                            @if (Auth::user()->id != $item->id)
                                            <form action="{{ route('anggota.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger waves-effect waves-light" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                            </form>
                                            @endif
                                            @else
                                                <p>-</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

@endpush
