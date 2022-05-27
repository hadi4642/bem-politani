@extends('layouts.app')

@section('title')
    {{ $kegiatan->nama_kegiatan }}
@endsection

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $kegiatan->nama_kegiatan }}</h4>

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
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="15%">Nama Kegiatan</th>
                            <td width="1%">:</td>
                            <td>{{ $kegiatan->nama_kegiatan }}</td>
                        </tr>
                        <tr>
                            <th>Tema Kegiatan</th>
                            <td>:</td>
                            <td>{{ $kegiatan->tema_kegiatan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>:</td>
                            <td>{{ $kegiatan->tanggal }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>:</td>
                            <td>{{ $kegiatan->waktu }}</td>
                        </tr>
                        <tr>
                            <th>Tempat</th>
                            <td>:</td>
                            <td>{{ $kegiatan->tempat }}</td>
                        </tr>
                        <tr>
                            <th>Struktur Panitia</th>
                            <td>:</td>
                            <td>{!! $kegiatan->struktur_panitia !!}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Peserta</th>
                            <td>:</td>
                            <td>{{ $kegiatan->jumlah_peserta }}</td>
                        </tr>
                        <tr>
                            <th>Dana Masuk</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($kegiatan->dana_masuk) }}</td>
                        </tr>
                        <tr>
                            <th>Dana Keluar</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($kegiatan->dana_keluar) }}</td>
                        </tr>
                        <tr>
                            <th>Dokumentasi Nota</th>
                            <td>:</td>
                            <td>
                                @foreach ($notas as $nota)
                                    <a href="{{ asset('storage/dokumentasi_nota/'.$nota->filename) }}" target="_blank">
                                        <img src="{{ asset('storage/dokumentasi_nota/'.$nota->filename) }}" width="200" class="rounded">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Dokumentasi Kegiatan</th>
                            <td>:</td>
                            <td>
                                @foreach ($dok_kegiatan as $item)
                                    <a href="{{ asset('storage/dokumentasi_kegiatan/'.$item->filename) }}" target="_blank">
                                        <img src="{{ asset('storage/dokumentasi_kegiatan/'.$item->filename) }}" width="200" class="rounded">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Diinput oleh</th>
                            <td>:</td>
                            <td>{{ $kegiatan->anggota->nama }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
