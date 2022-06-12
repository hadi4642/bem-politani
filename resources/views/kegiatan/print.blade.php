<html>
    <head>
        <title>{{ $kegiatan->nama_kegiatan }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 4cm 3cm 3cm 4cm;
        }

        *{
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 12pt !important;
        }

        header {
            position: fixed;
            top: -4cm;
            left: 0px;
            right: 0px;
            height: 4cm;
        }

        .address{
            font-size:7pt!important;
            margin-top:-16px;
        }

        p {
            font-size: 12pt;
            margin-top: -6px;
        }

        hr {
            border: 2px solid #000;
        }

        th {
            text-align: left;
        }

        table.dana {
            border: 1px solid #000;
        }

        table.dana tbody tr td {
            border: 1px solid #000;
            padding: 0.2rem 0.6rem;
        }

        table.dana tr th {
            border: 1px solid #000;
            padding: 0.2rem 0.6rem;
        }

        .f-14{
            font-size: 14pt;
        }

        .f-12{
            font-size: 12pt;
        }

        h5{
            font-size: 14pt!important;
        }

        h6{
            font-size: 12pt!important;
        }

        .sub{
            text-indent: 24px;
        }

        table#pengesahan tr {
            vertical-align: top;
        }

        table#pengesahan tr td{
            padding: 4px 0;
        }

        </style>
    </head>
    <body>
        <!-- Define header blocks before your content -->
        <header style="margin: 0.5cm -2.5cm 0 -3.5cm;">
            <table align="center">
                <tr>
                    <td>
                        <img src="{{ asset('assets/images/logo_politani.png') }}" width="100" alt="">
                    </td>
                    <td class="px-2">
                        <h5 class="text-center">BADAN EKSEKUTIF MAHASISWA</h5>
                        <h6 class="text-center f-12" style="margin-top:-6px;">POLITEKNIK PERTANIAN NEGERI SAMARINDA</h6>
                        <div class="text-center">
                            <p class="address mt-1">Sekretariat: Jl. Samratulangi Kel.Gunung panjang Kec.Smd Seberang Kontak : 085391110006/085751723431</p>
                            <p class="address">Website :www.politanisamarinda.ac.id email :bem.politanismd@gmai.com - ig :bem.politani</p>
                        </div>
                    </td>
                    <td>
                        <img src="{{ asset('assets/images/logo_bem.png') }}" width="100" alt="">
                    </td>
                </tr>
            </table>
            <hr>
        </header>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            {{-- Cover (Halaman 1) --}}
            <p style="page-break-after: never">
                <h5 class="text-center text-uppercase mx-3" style="line-height: 32px">
                    LAPORAN PERTANGGUNG JAWABAN {{ $kegiatan->anggota->divisi->nama_divisi }} BADAN EKSEKUTIF MAHASISWA PERIODE {{ $kegiatan->kabinet->periode }} KABINET {{ $kegiatan->kabinet->nama_kabinet }} POLITEKNIK PERTANIAN NEGERI SAMARINDA
                </h5>
                <br><br><br><br>
                <div class="my-5">
                    <table align="center">
                        <tr>
                            <td>
                                <img src="{{ asset('assets/images/logo_politani.png') }}" width="100" alt="">
                            </td>
                            <td>
                                <img src="{{ asset('assets/images/logo_bem.png') }}" width="100" alt="" class="mx-4">
                            </td>
                            <td>
                                <img src="{{ asset('logo_kabinet/'.$kegiatan->kabinet->logo) }}" width="100" alt="">
                            </td>
                        </tr>
                    </table>
                </div>
                <br><br><br><br>
                <h5 class="text-center">
                    BADAN EKSEKUTIF MAHASISWA
                </h5>
                <h5 class="text-center">
                    POLITEKNIK PERTANIAN NEGERI SAMARINDA
                </h5>
                <h5 class="text-center text-uppercase">
                    {{ $kegiatan->kabinet->periode }}
                </h5>
                <p class="f-12 text-center mt-2">Sekretariat : Jl. Samaratulangi Kel. Gunung Panjang Kec. Smd Seberang Kontak : 085391110006</p>
                <p class="f-12 text-center"> website : <a href="">www.politanisamarinda.ac.id</a></p>
            </p>
            {{-- End Cover --}}
            {{-- Lembar Pengesahan (Halaman 2) --}}
            <p style="page-break-after: always">
                <h6 class="text-center">LEMBAR PENGESAHAN</h6>
                <h6 class="text-center text-uppercase">LAPORAN PERTANGGUNG JAWABAN {{ $kegiatan->anggota->divisi->nama_divisi }}</h6>
                <h6 class="text-center">BADAN EKSEKUTIF MAHASISWA POLITEKNIK PERTANIAN NEGERI SAMARINDA</h6>
                <h6 class="text-center">{{ $kegiatan->kabinet->periode }}</h6>
                <br>

                <table id="pengesahan">
                    <tr>
                        <td width="50%">NAMA ORGANISASI</td>
                        <td>:&nbsp;</td>
                        <td width="50%">Badan Eksekutif Mahasiswa Politeknik Pertanian Negeri Samarinda</td>
                    </tr>
                    <tr>
                        <td>NAMA KOORDINATOR</td>
                        <td>:&nbsp;</td>
                        <td>{{ $kegiatan->anggota->nama }}</td>
                    </tr>
                    <tr>
                        <td>JURUSAN</td>
                        <td>:&nbsp;</td>
                        <td>{{ $kegiatan->anggota->prodi->nama_prodi }}</td>
                    </tr>
                    <tr>
                        <td>NOMOR HANDPHONE</td>
                        <td>:&nbsp;</td>
                        <td>{{ $kegiatan->anggota->no_telp }}</td>
                    </tr>
                    <tr>
                        <td>BIAYA YANG TELAH TERPAKAI</td>
                        <td>:&nbsp;</td>
                        <td><strong>{{ number_format($total_pengeluaran, 0, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td>TERBILANG</td>
                        <td>:&nbsp;</td>
                        <td>{{ $terbilang }} Rupiah</td>
                    </tr>
                </table>
                <br><br><br><br><br>
                <table style="float:right">
                    <tr>
                        <td>Koordinator {{ $kegiatan->anggota->divisi->nama_divisi }} {{ $kegiatan->kabinet->periode }}</td>
                    </tr>
                    <tr>
                        <td>Badan Eksekutif Mahasiswa</td>
                    </tr>
                    <tr>
                        <td>Politeknik Pertanian Negeri Samarinda</td>
                    </tr>
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($kegiatan->created_at)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td><u>{{ $kegiatan->anggota->nama }}</u></td>
                    </tr>
                </table>

            </p>
            {{-- End Lembar Pengesahan --}}
            {{-- Isi (Halaman 3+++)--}}
            <p style="page-break-after: always;">
                <h5 class="text-center text-uppercase">
                    {{ $kegiatan->nama_kegiatan }}
                </h5>
                <h5 class="text-center">
                    BADAN EKSEKUTIF MAHASISWA
                </h5>
                <h5 class="text-center">
                    POLITEKNIK PERTANIAN NEGERI SAMARINDA
                </h5>
                <br>
                <h5>
                    A. LATAR BELAKANG
                </h5>
                <p>{!! $kegiatan->latar_belakang !!}</p>
                <br>
                <h5>
                    B. TUJUAN
                </h5>
                <p>{!! $kegiatan->tujuan !!}</p>
                <br>
                <h5>
                    C. TEMPAT KEGIATAN
                </h5>
                <p>Tempat : {{ $kegiatan->tempat }}</p>
                <br>
                <h5>
                    D. SASARAN KEGIATAN
                </h5>
                <p>{!! $kegiatan->sasaran_kegiatan !!}</p>
                <br>
                <h5>
                    E. PENUTUP
                </h5>
                <p>{!! $kegiatan->penutup !!}</p>
                <br>
                <h5>
                    F. LAMPIRAN - LAMPIRAN
                </h5>
                <br>
                <p class="f-12 sub"><strong>&emsp;a. Susunan Kepanitiaan</strong></p>
                <p>{!! $kegiatan->struktur_panitia !!}</p>
                <br>
                <p class="f-12 sub"><strong>&emsp;b. Pemasukan</strong></p>
                <table class="table table-striped table-bordered dana mx-2">
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
                <br>
                <p class="f-12 sub"><strong>c. Pengeluaran</strong></p>
                <table class="table table-striped table-bordered dana mx-1" border="1">
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
                <br>
                <p class="f-12 sub"><strong>d. Dokumentasi Nota</strong></p>
                <br>
                @foreach ($notas as $nota)
                    <img src="{{ asset('dokumentasi_nota/'.$nota->filename) }}" height="200" class="p-2 rounded">
                @endforeach
                <br>
                <p class="f-12 sub"><strong>e. Dokumentasi Kegiatan</strong></p>
                <br>
                @foreach ($dok_kegiatan as $item)
                    <img src="{{ asset('dokumentasi_kegiatan/'.$item->filename) }}" height="200"
                class="p-2 rounded">
                @endforeach
            </p>
            {{-- END isi --}}
        </main>
    </body>
</html>
