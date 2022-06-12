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
            $target_realisasi[] = [
                "nama_kabinet" => 'Kabinet '.$kabinet->nama_kabinet. "($kabinet->periode)",
                "target" => $kabinet->target_kegiatan,
                "realisasi" => $kabinet->kegiatans->count(),
            ];
        }

        $nama_kabinet = [];
        $target = [];
        $realisasi = [];
        foreach($target_realisasi as $target_realisasi){
            $nama_kabinet[] = $target_realisasi['nama_kabinet'];
            $target[] = $target_realisasi['target'];
            $realisasi[] = $target_realisasi['realisasi'];
        }

        // reverse array
        $nama_kabinet = array_reverse($nama_kabinet);
        $target = array_reverse($target);
        $realisasi = array_reverse($realisasi);

        return view('dashboard', compact('jumlah_divisi', 'jumlah_anggota', 'jumlah_kegiatan', 'kegiatan', 'nama_kabinet', 'target', 'realisasi'));
    }
}
