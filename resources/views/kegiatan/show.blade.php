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
                <div class="table-responsive">
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
                                <th>Kabinet</th>
                                <td>:</td>
                                <td>{{ $kegiatan->kabinet->nama_kabinet }}</td>
                            </tr>
                            <tr>
                                <th>Latar Belakang</th>
                                <td>:</td>
                                <td>{!! $kegiatan->latar_belakang !!}</td>
                            </tr>
                            <tr>
                                <th>Tujuan</th>
                                <td>:</td>
                                <td>{!! $kegiatan->tujuan !!}</td>
                            </tr>
                            <tr>
                                <th>Tempat</th>
                                <td>:</td>
                                <td>{{ $kegiatan->tempat }}</td>
                            </tr>
                            <tr>
                                <th>Sasaran Kegiatan</th>
                                <td>:</td>
                                <td>{!! $kegiatan->sasaran_kegiatan !!}</td>
                            </tr>
                            <tr>
                                <th>Penutup</th>
                                <td>:</td>
                                <td>{!! $kegiatan->penutup !!}</td>
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
                                <th>Pemasukan</th>
                                <td>:</td>
                                <td>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>No</th>
                                                <th>Uraian</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pemasukan as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->uraian }}</td>
                                                <td>Rp{{ number_format($row->total, 0, ',', '.') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-center">Grand Total</th>
                                                <th>Rp{{ number_format($total_pemasukan, 0, ',', '.') }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th>Pengeluaran</th>
                                <td>:</td>
                                <td>
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>No</th>
                                                <th>Uraian</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengeluaran as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->uraian }}</td>
                                                <td>{{ $row->jumlah }}</td>
                                                <td>Rp{{ number_format($row->harga_satuan, 0, ',', '.') }}</td>
                                                <td>Rp{{ number_format($row->jumlah * $row->harga_satuan, 0, ',', '.') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-center">Grand Total</th>
                                                <th>Rp{{ number_format($total_pengeluaran, 0, ',', '.') }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th>Dokumentasi Nota</th>
                                <td>:</td>
                                <td>
                                    @foreach ($notas as $nota)
                                    <a href="{{ asset('dokumentasi_nota/'.$nota->filename) }}" target="_blank">
                                        <img src="{{ asset('dokumentasi_nota/'.$nota->filename) }}" width="200"
                                            class="rounded">
                                    </a>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>Dokumentasi Kegiatan</th>
                                <td>:</td>
                                <td>
                                    @foreach ($dok_kegiatan as $item)
                                    <a href="{{ asset('dokumentasi_kegiatan/'.$item->filename) }}" target="_blank">
                                        <img src="{{ asset('dokumentasi_kegiatan/'.$item->filename) }}" width="200"
                                            class="rounded">
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
</div>
@endsection
