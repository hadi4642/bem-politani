<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Anggota;
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
        return view('dashboard', compact('jumlah_divisi', 'jumlah_anggota', 'jumlah_kegiatan', 'kegiatan'));
    }
}
