<?php

namespace App\Http\Controllers;

use \NumberFormatter;
use App\Models\Kabinet;
use App\Models\Kegiatan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DokumentasiNota;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\DokumentasiKegiatan;
use RealRashid\SweetAlert\Facades\Alert;

class KegiatanController extends Controller
{
    // Hanya role admin yang bisa mengakses halaman ini
    public function __construct()
    {
        $this->middleware('admin')->only('create','edit', 'destroy');
    }

    public function index()
    {
        $kegiatan = Kegiatan::all();
        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        $kabinets = Kabinet::all();
        return view('kegiatan.create', compact('kabinets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'=>'required',
            'tema_kegiatan'=>'required',
            'tanggal'=>'required',
            'waktu'=>'required',
            'kabinet_id'=>'required',
            'latar_belakang' => 'required',
            'tujuan' => 'required',
            'tempat'=>'required',
            'sasaran_kegiatan'=>'required',
            'penutup'=>'required',
            'struktur_panitia'=>'required',
            'jumlah_peserta'=>'required',
        ]);

        DB::beginTransaction();

        try {
            // Insert to Table Kegiatan
            $kegiatan = Kegiatan::create([
                'nama_kegiatan' => $request['nama_kegiatan'],
                'tema_kegiatan' => $request['tema_kegiatan'],
                'tanggal' => $request['tanggal'],
                'waktu' => $request['waktu'],
                'kabinet_id' => $request['kabinet_id'],
                'latar_belakang' => $request['latar_belakang'],
                'tujuan' => $request['tujuan'],
                'tempat' => $request['tempat'],
                'sasaran_kegiatan' => $request['sasaran_kegiatan'],
                'penutup' => $request['penutup'],
                'struktur_panitia' => $request['struktur_panitia'],
                'jumlah_peserta' => $request['jumlah_peserta'],
                'anggota_id' => auth()->user()->id,
            ]);

            // Insert to Table Pemasukan
            foreach($request->uraian_pemasukan as $key => $value) {
                $rupiah = Str::replaceFirst('Rp', '', $request->total_pemasukan[$key]);
                $pemasukan= Str::replace('.', '', $rupiah);
                Pemasukan::create([
                    'uraian' => $value,
                    'total' => $pemasukan,
                    'kegiatan_id' => $kegiatan->id,
                ]);
            }

            // Insert to Table Pengeluaran
            foreach($request->uraian_pengeluaran as $key => $value) {
                $rupiah = Str::replaceFirst('Rp', '', $request->harga_satuan[$key]);
                $satuan= Str::replace('.', '', $rupiah);
                Pengeluaran::create([
                    'uraian' => $value,
                    'jumlah' => $request->jumlah_pengeluaran[$key],
                    'harga_satuan' => $satuan,
                    'kegiatan_id' => $kegiatan->id,
                ]);
            }

            // Insert to Table Dokumentasi Nota
            if ($request->hasFile('dokumentasi_nota')) {
                $notas = $request->file('dokumentasi_nota');

                foreach($notas as $nota) {
                    $filename = date('YmdHis').'_'.$nota->getClientOriginalName();
                    $path = public_path('dokumentasi_nota');
                    $nota->move($path, $filename);
                    DokumentasiNota::create(['filename' => $filename, 'kegiatan_id' => $kegiatan->id]);
                }
            }

            // Insert to Table Dokumentasi Kegiatan
            if ($request->hasFile('dokumentasi_kegiatan')) {
                $kegiatans = $request->file('dokumentasi_kegiatan');

                foreach($kegiatans as $kegiatann) {
                    $filename = date('YmdHis').'_'.$kegiatann->getClientOriginalName();
                    $path = public_path('dokumentasi_kegiatan');
                    $kegiatann->move($path, $filename);
                    DokumentasiKegiatan::create(['filename' => $filename, 'kegiatan_id' => $kegiatan->id]);
                }
            }

            DB::commit();
            Alert::toast('Kegiatan '. $request->nama_kegiatan.' berhasil ditambah','success');
            return redirect()->route('kegiatan.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('kegiatan.index')->with('error', 'Data gagal ditambahkan');
        }
    }

    public function show(Kegiatan $kegiatan)
    {
        $notas = DokumentasiNota::where('kegiatan_id', $kegiatan->id)->get();
        $dok_kegiatan = DokumentasiKegiatan::where('kegiatan_id', $kegiatan->id)->get();
        $pemasukan = Pemasukan::where('kegiatan_id', $kegiatan->id)->get();
        // get total pemasukan
        $total_pemasukan = 0;
        foreach($pemasukan as $pemasukans) {
            $total_pemasukan += $pemasukans->total;
        }
        $pengeluaran = Pengeluaran::where('kegiatan_id', $kegiatan->id)->get();
        // get total pengeluaran
        $total_pengeluaran = 0;
        foreach($pengeluaran as $pengeluarans) {
            $total_pengeluaran += $pengeluarans->harga_satuan * $pengeluarans->jumlah;
        }
        return view('kegiatan.show', compact('kegiatan', 'notas', 'dok_kegiatan', 'pemasukan', 'pengeluaran', 'total_pemasukan', 'total_pengeluaran'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kabinets = Kabinet::all();
        $pemasukan = Pemasukan::where('kegiatan_id', $kegiatan->id)->get();
        $pengeluaran = Pengeluaran::where('kegiatan_id', $kegiatan->id)->get();
        return view('kegiatan.edit', compact('kegiatan', 'kabinets', 'pemasukan', 'pengeluaran'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan'=>'required',
            'tema_kegiatan'=>'required',
            'tanggal'=>'required',
            'waktu'=>'required',
            'kabinet_id'=>'required',
            'latar_belakang' => 'required',
            'tujuan' => 'required',
            'tempat'=>'required',
            'sasaran_kegiatan'=>'required',
            'penutup'=>'required',
            'struktur_panitia'=>'required',
            'jumlah_peserta'=>'required',
        ]);

        DB::beginTransaction();

        try {
            // Update table kegiatan
            $kegiatan->update([
                'nama_kegiatan' => $request['nama_kegiatan'],
                'tema_kegiatan' => $request['tema_kegiatan'],
                'tanggal' => $request['tanggal'],
                'waktu' => $request['waktu'],
                'kabinet_id' => $request['kabinet_id'],
                'latar_belakang' => $request['latar_belakang'],
                'tujuan' => $request['tujuan'],
                'tempat' => $request['tempat'],
                'sasaran_kegiatan' => $request['sasaran_kegiatan'],
                'penutup' => $request['penutup'],
                'struktur_panitia' => $request['struktur_panitia'],
                'jumlah_peserta' => $request['jumlah_peserta'],
                'anggota_id' => auth()->user()->id,
            ]);

            // Delete table pemasukan
            Pemasukan::where('kegiatan_id', $kegiatan->id)->delete();

            // Insert to Table Pemasukan
            foreach($request->uraian_pemasukan as $key => $value) {
                $rupiah = Str::replaceFirst('Rp', '', $request->total_pemasukan[$key]);
                $pemasukan= Str::replace('.', '', $rupiah);
                Pemasukan::create([
                    'uraian' => $value,
                    'total' => $pemasukan,
                    'kegiatan_id' => $kegiatan->id,
                ]);
            }

            // Delete table pengeluaran
            Pengeluaran::where('kegiatan_id', $kegiatan->id)->delete();

            // Insert to Table Pengeluaran
            foreach($request->uraian_pengeluaran as $key => $value) {
                $rupiah = Str::replaceFirst('Rp', '', $request->harga_satuan[$key]);
                $satuan= Str::replace('.', '', $rupiah);
                Pengeluaran::create([
                    'uraian' => $value,
                    'jumlah' => $request->jumlah_pengeluaran[$key],
                    'harga_satuan' => $satuan,
                    'kegiatan_id' => $kegiatan->id,
                ]);
            }

            // Jika input file ada isinya
            if ($request->hasFile('dokumentasi_nota')) {
                // Hapus gambar sebelumnya
                $notas2 = DokumentasiNota::where('kegiatan_id', $kegiatan->id)->get();
                foreach($notas2 as $nota) {
                    $nota->delete();
                    $image_path = public_path('dokumentasi_nota/'.$nota->filename);
                    if(file_exists($image_path)) {
                        unlink($image_path);
                    }
                }
                // Insert Gambar Baru
                $notas = $request->file('dokumentasi_nota');
                foreach($notas as $nota) {
                    $filename = date('YmdHis').'_'.$nota->getClientOriginalName();
                    $path = public_path('dokumentasi_nota');
                    $nota->move($path, $filename);
                    DokumentasiNota::create(['filename' => $filename, 'kegiatan_id' => $kegiatan->id]);
                }
            }

            // Jika input file ada isinya
            if ($request->hasFile('dokumentasi_kegiatan')) {
                // Hapus gambar sebelumnya
                $kegiatans2 = DokumentasiKegiatan::where('kegiatan_id', $kegiatan->id)->get();
                foreach($kegiatans2 as $kegiatann) {
                    $kegiatann->delete();
                    $image_path = public_path('dokumentasi_kegiatan/'.$kegiatann->filename);
                    if(file_exists($image_path)) {
                        unlink($image_path);
                    }
                }
                // Insert Gambar Baru
                $kegiatans = $request->file('dokumentasi_kegiatan');
                foreach($kegiatans as $kegiatann) {
                    $filename = date('YmdHis').'_'.$kegiatann->getClientOriginalName();
                    $path = public_path('dokumentasi_kegiatan');
                    $kegiatann->move($path, $filename);
                    DokumentasiKegiatan::create(['filename' => $filename, 'kegiatan_id' => $kegiatan->id]);
                }
            }

            DB::commit();
            Alert::toast('Kegiatan berhasil diedit','success');
            return redirect()->route('kegiatan.index');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('kegiatan.index')->with('error', 'Data gagal diedit');
        }
    }

    public function destroy(Kegiatan $kegiatan)
    {
        DB::beginTransaction();

        try {
            // Delete pemasukan kegiatan
            Pemasukan::where('kegiatan_id', $kegiatan->id)->delete();

            // Delete pengeluaran kegaitan
            Pengeluaran::where('kegiatan_id', $kegiatan->id)->delete();

            // Delete Dokumentasi Nota kegiatan
            $notas = DokumentasiNota::where('kegiatan_id', $kegiatan->id)->get();
            foreach($notas as $nota) {
                $nota->delete();
                $image_path = public_path('dokumentasi_nota/'.$nota->filename);
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            // Delete Dokumentasi Kegiatan
            $kegiatans = DokumentasiKegiatan::where('kegiatan_id', $kegiatan->id)->get();
            foreach($kegiatans as $kegiatann) {
                $kegiatann->delete();
                $image_path = public_path('dokumentasi_kegiatan/'.$kegiatann->filename);
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $kegiatan->delete();
            DB::commit();
            Alert::toast('Kegiatan '. $kegiatan->nama_kegiatan.' berhasil dihapus','success');
            return redirect()->route('kegiatan.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('kegiatan.index')->with('error', 'Data gagal dihapus');
        }
    }

    public function print($id)
    {
        $kegiatan = Kegiatan::find($id);
        $notas = DokumentasiNota::where('kegiatan_id', $kegiatan->id)->get();
        $dok_kegiatan = DokumentasiKegiatan::where('kegiatan_id', $kegiatan->id)->get();
        $pemasukan = Pemasukan::where('kegiatan_id', $kegiatan->id)->get();
        // get total pemasukan
        $total_pemasukan = 0;
        foreach($pemasukan as $pemasukans) {
            $total_pemasukan += $pemasukans->total;
        }
        $pengeluaran = Pengeluaran::where('kegiatan_id', $kegiatan->id)->get();
        // get total pengeluaran
        $total_pengeluaran = 0;
        foreach($pengeluaran as $pengeluarans) {
            $total_pengeluaran += $pengeluarans->harga_satuan * $pengeluarans->jumlah;
        }
        $numberFormat = new NumberFormatter('id', NumberFormatter::SPELLOUT);
        $terbilang = ucwords($numberFormat->format($total_pengeluaran));

        $pdf = PDF::loadView('kegiatan.print', compact('kegiatan', 'notas', 'dok_kegiatan', 'pemasukan', 'pengeluaran', 'total_pemasukan', 'total_pengeluaran', 'terbilang'));
        // return view('kegiatan.print', compact('kegiatan', 'notas', 'dok_kegiatan', 'pemasukan', 'pengeluaran', 'total_pemasukan', 'total_pengeluaran'));
        return $pdf->stream();
        // return $pdf->download('print.pdf');
    }
}
