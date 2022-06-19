<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Anggota;
use App\Models\Kabinet;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_divisi = Divisi::count();
        $jumlah_anggota = Anggota::count();
        $jumlah_kegiatan = Kegiatan::count();
        $kegiatan = Kegiatan::orderBy('tanggal', 'desc')->limit(5)->get();
        $kabinets = Kabinet::limit(3)->orderBy('id', 'desc')->get();
        $target_realisasi = [];
        foreach ($kabinets as $kabinet) {
            // Array asosiasi
            // Menambahkan isi array target_realisasi
            $target_realisasi[] = [
                "nama_kabinet" => 'Kabinet '.$kabinet->nama_kabinet. "($kabinet->periode)",
                "target" => $kabinet->target_kegiatan,
                "realisasi" => $kabinet->kegiatans->count(),
            ];
        }

        $nama_kabinet = [];
        $target = [];
        $realisasi = [];
        foreach($target_realisasi as $tr){
            // Tambahkan isi array nama_kabinet, target dan realisasi dengan mengambil isi dari array target_realisasi
            $nama_kabinet[] = $tr['nama_kabinet'];
            $target[] = $tr['target'];
            $realisasi[] = $tr['realisasi'];
        }

        // reverse isi array
        // Cth : [3,2,1] => [1,2,3]
        $nama_kabinet = array_reverse($nama_kabinet);
        $target = array_reverse($target);
        $realisasi = array_reverse($realisasi);

        return view('dashboard', compact('jumlah_divisi', 'jumlah_anggota', 'jumlah_kegiatan', 'kegiatan', 'nama_kabinet', 'target', 'realisasi'));
    }
}
