<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Anggota;
use App\Models\Divisi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    // Hanya role admin yang bisa mengakses halaman ini
    public function __construct()
    {
        $this->middleware('admin')->only('create','edit', 'destroy');
    }

    public function index()
    {
        $anggotas = Anggota::all();
        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        $divisi = Divisi::all();
        return view('anggota.create', compact('prodi', 'divisi'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'prodi_id' => 'required',
            'tahun_angkatan' => 'required',
            'divisi_id' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        // bycript input password
        $request['password'] = bcrypt($request->password);
        Anggota::create($request->all());
        Alert::toast('Anggota '. $request->nama_anggota.' berhasil ditambah','success');
        return redirect()->route('anggota.index');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $prodi = Prodi::all();
        $divisi = Divisi::all();
        return view('anggota.edit',compact('anggota', 'prodi', 'divisi'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'prodi_id' => 'required',
            'tahun_angkatan' => 'required',
            'divisi_id' => 'required',
            'role' => 'required',
        ]);
        // Jika input password kosong
        if ($request->password == '') {
            // hapus $request->password
            unset($request['password']);
        } else {
            // ganti password dengan bcrypt
            $request['password'] = bcrypt($request->password);
        }

        Anggota::findOrFail($id)->update($request->all());
        Alert::toast('Data anggota berhasil diedit','success');
        return redirect()->route('anggota.index');
    }

    public function destroy($id)
    {
        try{
            Anggota::findOrFail($id)->delete();
            Alert::toast('Data anggota berhasil dihapus','success');
        } catch (\Throwable $th) {
            Alert::toast('Data Anggota Gagal dihapus','error');
        }
        return redirect()->route('anggota.index');
    }
}
