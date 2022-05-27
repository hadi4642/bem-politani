<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\DokumentasiNota;
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
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'=>'required',
            'tema_kegiatan'=>'required',
            'tanggal'=>'required',
            'waktu'=>'required',
            'tempat'=>'required',
            'struktur_panitia'=>'required',
            'jumlah_peserta'=>'required',
            'dana_masuk'=>'required',
            'dana_keluar'=>'required',
        ]);

        $kegiatan = Kegiatan::create([
            'nama_kegiatan' => $request['nama_kegiatan'],
            'tema_kegiatan' => $request['tema_kegiatan'],
            'tanggal' => $request['tanggal'],
            'waktu' => $request['waktu'],
            'tempat' => $request['tempat'],
            'struktur_panitia' => $request['struktur_panitia'],
            'jumlah_peserta' => $request['jumlah_peserta'],
            'dana_masuk' => $request['dana_masuk'],
            'dana_keluar' => $request['dana_keluar'],
            'anggota_id' => auth()->user()->id,
        ]);

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

        Alert::toast('Kegiatan '. $request->nama_kegiatan.' berhasil ditambah','success');
        return redirect()->route('kegiatan.index');
    }

    public function show(Kegiatan $kegiatan)
    {
        $notas = DokumentasiNota::where('kegiatan_id', $kegiatan->id)->get();
        $dok_kegiatan = DokumentasiKegiatan::where('kegiatan_id', $kegiatan->id)->get();
        return view('kegiatan.show', compact('kegiatan', 'notas', 'dok_kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan'=>'required',
            'tema_kegiatan'=>'required',
            'tanggal'=>'required',
            'waktu'=>'required',
            'tempat'=>'required',
            'struktur_panitia'=>'required',
            'jumlah_peserta'=>'required',
            'dana_masuk'=>'required',
            'dana_keluar'=>'required',
        ]);

        $kegiatan->update([
            'nama_kegiatan' => $request['nama_kegiatan'],
            'tema_kegiatan' => $request['tema_kegiatan'],
            'tanggal' => $request['tanggal'],
            'waktu' => $request['waktu'],
            'tempat' => $request['tempat'],
            'struktur_panitia' => $request['struktur_panitia'],
            'jumlah_peserta' => $request['jumlah_peserta'],
            'dana_masuk' => $request['dana_masuk'],
            'dana_keluar' => $request['dana_keluar'],
            'anggota_id' => auth()->user()->id,
        ]);

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

        Alert::toast('Kegiatan '. $request->nama_kegiatan.' berhasil ditambah','success');
        return redirect()->route('kegiatan.index');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $notas = DokumentasiNota::where('kegiatan_id', $kegiatan->id)->get();
        foreach($notas as $nota) {
            $nota->delete();
            $image_path = public_path('dokumentasi_nota/'.$nota->filename);
            if(file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $kegiatans = DokumentasiKegiatan::where('kegiatan_id', $kegiatan->id)->get();
        foreach($kegiatans as $kegiatann) {
            $kegiatann->delete();
            $image_path = public_path('dokumentasi_kegiatan/'.$kegiatann->filename);
            if(file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $kegiatan->delete();
        Alert::toast('Kegiatan '. $kegiatan->nama_kegiatan.' berhasil dihapus','success');
        return redirect()->route('kegiatan.index');
    }
}
