@extends('layouts.app')

@section('title', 'Edit Data Kegiatan')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Kegiatan</h4>

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
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input class="form-control" type="text" id="nama_kegiatan" name="nama_kegiatan" required autofocus value="{{ $kegiatan->nama_kegiatan }}">
                        @error('nama_kegiatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tema_kegiatan">Tema Kegiatan</label>
                        <input class="form-control" type="text" id="tema_kegiatan" name="tema_kegiatan" required value="{{ $kegiatan->tema_kegiatan }}">
                        @error('tema_kegiatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal</label>
                        <input class="form-control" type="date" id="tanggal" name="tanggal" required value="{{ $kegiatan->tanggal }}">
                        @error('tanggal')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="waktu">Waktu</label>
                        <input class="form-control" type="time" id="waktu" name="waktu" required value="{{ $kegiatan->waktu }}">
                        @error('waktu')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kabinet_id">Kabinet</label>
                        <select name="kabinet_id" id="kabinet_id" class="form-control">
                            @foreach ($kabinets as $kabinet)
                                <option value="{{ $kabinet->id }}" {{ $kegiatan->kabinet_id == $kabinet->id ? 'selected' : '' }}>{{ $kabinet->nama_kabinet }}</option>
                            @endforeach
                        </select>
                        @error('kabinet_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="elm1">Latar Belakang</label>
                        <textarea name="latar_belakang">{{ $kegiatan->latar_belakang }}</textarea>
                        @error('latar_belakang')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="elm1">Tujuan Kegiatan</label>
                        <textarea name="tujuan">{{ $kegiatan->tujuan }}</textarea>
                        @error('tujuan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tempat">Tempat</label>
                        <input class="form-control" type="text" id="tempat" name="tempat" required value="{{ $kegiatan->tempat }}">
                        @error('tempat')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="elm1">Sasaran Kegiatan</label>
                        <textarea name="sasaran_kegiatan">{{ $kegiatan->sasaran_kegiatan }}</textarea>
                        @error('sasaran_kegiatan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="elm1">Penutup</label>
                        <textarea name="penutup">{{ $kegiatan->penutup }}</textarea>
                        @error('penutup')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="elm1">Struktur Panitia</label>
                        <textarea id="elm1" name="struktur_panitia">{{ $kegiatan->struktur_panitia }}</textarea>
                        @error('struktur_panitia')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input class="form-control" type="number" id="jumlah_peserta" name="jumlah_peserta" required value="{{ $kegiatan->jumlah_peserta }}">
                        @error('jumlah_peserta')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dana_masuk">Pemasukan</label>
                        <table class="table table-bordered" id="table_pemasukan">
                            <tr>
                                <th>No</th>
                                <th>Uraian</th>
                                <th>Total</th>
                                <th>#</th>
                            </tr>
                            @foreach ($pemasukan as $row)
                            <tr>
                                <input type="hidden" name="id_pemasukan[]" value="{{ $row->id}}">
                                <td></td>
                                <td>
                                    <input type="text" name="uraian_pemasukan[]" class="form-control" value="{{ $row->uraian }}" required>
                                </td>
                                <td>
                                    <input type="text" name="total_pemasukan[]" class="form-control total-pemasukan" value="{{ $row->total }}" required>
                                </td>
                                @if ($loop->first)
                                    <td>
                                        <button type="button" name="add" id="tambah_pemasukan" class="btn btn-outline-primary">Tambah</button>
                                    </td>
                                @else
                                    <td>
                                        <button type="button" name="remove" id="hapus_pengeluaran" class="btn btn-outline-danger">Hapus</button>
                                    </td>
                                @endif
                            @endforeach
                        </table>
                        @error('dana_masuk')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dana_keluar">Pengeluaran</label>
                        <table class="table table-bordered" id="table_pengeluaran">
                            <tr>
                                <th>No</th>
                                <th>Uraian</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>#</th>
                            </tr>
                            @foreach ($pengeluaran as $row)
                            <tr>
                                <input type="hidden" name="id_pengeluaran[]" value="{{ $row->id}}">
                                <td></td>
                                <td>
                                    <input type="text" name="uraian_pengeluaran[]" class="form-control" value="{{ $row->uraian }}" required>
                                </td>
                                <td>
                                    <input type="number" name="jumlah_pengeluaran[]" placeholder="Input Jumlah" min="1" class="form-control" value="{{ $row->jumlah }}" required>
                                </td>
                                <td>
                                    <input type="text" name="harga_satuan[]" placeholder="Input Harga Satuan" class="form-control satuan-pengeluaran" value="{{ $row->harga_satuan }}" required>
                                </td>
                                @if ($loop->first)
                                    <td>
                                        <button type="button" name="add" id="tambah_pengeluaran" class="btn btn-outline-primary">Tambah</button>
                                    </td>
                                @else
                                    <td>
                                        <button type="button" name="remove" id="hapus_pengeluaran" class="btn btn-outline-danger">Hapus</button>
                                    </td>
                                @endif
                            @endforeach
                        </table>
                        @error('dana_keluar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dokumentasi_nota">Dokumentasi Nota</label><span class="text-danger" style="font-size: 10px;"><i> *Kosongkan kolom jika tidak ingin merubah gambar</i></span>
                        <input class="form-control" type="file" id="dokumentasi_nota" name="dokumentasi_nota[]" multiple>
                        @error('dokumentasi_nota')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dokumentasi_kegiatan">Dokumentasi Kegiatan</label><span class="text-danger" style="font-size: 10px;"><i> *Kosongkan kolom jika tidak ingin merubah gambar</i></span>
                        <input class="form-control" type="file" id="dokumentasi_kegiatan" name="dokumentasi_kegiatan[]" multiple>
                        @error('dokumentasi_kegiatan')
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

@push('scripts')
<!--tinymce js-->
<script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>

<!-- init js -->
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
<script type="text/javascript">
    setNomorPemasukan();
    setNomorPengeluaran();
    format_input();

    $('.total-pemasukan').each(function(index, element) {
        var total_pemasukan = $(this).val();
        $(this).val(formatRupiah(total_pemasukan, 'Rp'));
    });

    $('.satuan-pengeluaran').each(function(index, element) {
        var satuan_pengeluaran = $(this).val();
        $(this).val(formatRupiah(satuan_pengeluaran, 'Rp'));
    });

    var noPemasukan = 0;
    $("#tambah_pemasukan").click(function () {
        ++noPemasukan;
        $("#table_pemasukan").append(`<tr>
            <td>${noPemasukan}</td>
            <td><input type="text" name="uraian_pemasukan[]" placeholder="Input Pemasukan" class="form-control" required /></td>
            <td><input type="text" name="total_pemasukan[]" placeholder="Input Total" class="form-control total-pemasukan" required /></td>
            <td><button type="button" name="remove" id="hapus_pemasukan" class="btn btn-outline-danger">Hapus</button></td>
            </tr>`);
        setNomorPemasukan();
        format_input();
    });
    $(document).on('click', '#hapus_pemasukan', function () {
        $(this).parents('tr').remove();
        setNomorPemasukan();
    });

    var noPengeluaran = 0;
    $("#tambah_pengeluaran").click(function () {
        ++noPengeluaran;
        $("#table_pengeluaran").append(`<tr>
            <td>${noPengeluaran}</td>
            <td><input type="text" name="uraian_pengeluaran[]" placeholder="Input Pengeluaran" class="form-control" required /></td>
            <td><input type="number" name="jumlah_pengeluaran[]" placeholder="Input Jumlah" min="1" class="form-control" required/></td>
            <td><input type="text" name="harga_satuan[]" placeholder="Input Harga Satuan" class="form-control satuan-pengeluaran" required/></td>
            <td><button type="button" name="remove" id="hapus_pengeluaran" class="btn btn-outline-danger">Hapus</button></td></tr>`);
        setNomorPengeluaran();
        format_input();
    });

    $(document).on('click', '#hapus_pengeluaran', function () {
        $(this).parents('tr').remove();
        setNomorPengeluaran();
    });

    function setNomorPengeluaran(){
        $("#table_pengeluaran tr").each(function(index) {
            $(this).find("td:first").html(index);
        });
    }

    function setNomorPemasukan(){
        $("#table_pemasukan tr").each(function(index) {
            $(this).find("td:first").html(index);
        });
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
    }

    function format_input(){
        $('.total-pemasukan').keyup(function() {
            // format rupiah
            var val = $(this).val();
            $(this).val(formatRupiah(val, 'Rp'));
        });

        $('.satuan-pengeluaran').keyup(function() {
            // format rupiah
            var val = $(this).val();
            $(this).val(formatRupiah(val, 'Rp'));
        });
    }
</script>
@endpush
