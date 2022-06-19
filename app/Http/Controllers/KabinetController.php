<?php

namespace App\Http\Controllers;

use App\Models\Kabinet;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KabinetController extends Controller
{

    // Hanya role admin yang bisa mengakses halaman ini
    public function __construct()
    {
        $this->middleware('admin')->only('create','edit', 'destroy');
    }

    public function index()
    {
        $kabinets = Kabinet::all();
        // count kegiatan kabinet
        $kabinets->each(function($kabinet){
            $kabinet->count = $kabinet->kegiatans->count();
        });

        return view('kabinet.index', compact('kabinets'));
    }

    public function create()
    {
        return view('kabinet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kabinet' => 'required',
            'periode' => 'required',
            'target_kegiatan' => 'required',
            'logo' => 'required|image',
        ]);

        $logo = $request->file('logo');
        $filename = date('YmdHis').'_'.$logo->getClientOriginalName();
        $path = public_path('logo_kabinet');
        $logo->move($path, $filename);

        Kabinet::create([
            'nama_kabinet' => $request->nama_kabinet,
            'periode' => $request->periode,
            'target_kegiatan' => $request->target_kegiatan,
            'logo' => $filename,
        ]);

        Alert::toast('Kabinet '. $request->nama_kabinet.' berhasil ditambah','success');
        return redirect()->route('kabinet.index');
    }

    public function edit(Kabinet $kabinet)
    {
        return view('kabinet.edit',compact('kabinet'));
    }

    public function update(Request $request, Kabinet $kabinet)
    {
        $request->validate([
            'nama_kabinet' => 'required',
            'periode' => 'required',
            'target_kegiatan' => 'required',
        ]);

        $input = $request->all();

        // Jika input logo ada filenya
        if($logo = $request->file('logo')) {
            // Hapus gambar sebelumnya
            $path = public_path('logo_kabinet/'.$kabinet->logo);
            if (file_exists($path)) {
                unlink($path);
            }
            // Insert Gambar Baru
            $filename = date('YmdHis').'_'.$logo->getClientOriginalName();
            $path = public_path('logo_kabinet');
            $logo->move($path, $filename);
            $input['logo'] = $filename;
        } else {
            // Hapus input logo
            unset($input['logo']);
        }

        $kabinet->update($input);
        Alert::toast('Data Kabinet berhasil diedit','success');
        return redirect()->route('kabinet.index');

    }

    public function destroy(Kabinet $kabinet)
    {
        try{
            $kabinet->delete();
            $path = public_path('logo_kabinet/'.$kabinet->logo);
            if (file_exists($path)) {
                unlink($path);
            }
            Alert::toast('Kabinet '. $kabinet->nama_kabinet.' berhasil dihapus','success');
        } catch (\Throwable $th) {
            Alert::toast('Kabinet '. $kabinet->nama_kabinet.' gagal dihapus','error');
        }
        return redirect()->route('kabinet.index');
    }
}
