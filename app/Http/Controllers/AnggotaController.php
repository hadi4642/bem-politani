<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Anggota;
use App\Models\Divisi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{

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
        if ($request->password == '') {
            unset($request['password']);
        } else {
            $request['password'] = bcrypt($request->password);
        }

        Anggota::findOrFail($id)->update($request->all());
        Alert::toast('Data anggota berhasil diedit','success');
        return redirect()->route('anggota.index');
    }

    public function destroy($id)
    {
        Anggota::findOrFail($id)->delete();
        Alert::toast('Data anggota berhasil dihapus','success');
        return redirect()->route('anggota.index');
    }
}
