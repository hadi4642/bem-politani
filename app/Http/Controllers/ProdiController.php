<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ProdiController extends Controller
{
    // Hanya role admin yang bisa mengakses halaman ini
    public function __construct()
    {
        $this->middleware('admin')->only('create','edit', 'destroy');
    }

    public function index()
    {
        $prodis = Prodi::all();
        return view('prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_prodi' => 'required',
        ]);

        Prodi::create($request->all());
        Alert::toast('Prodi '. $request->nama_prodi.' berhasil ditambah','success');
        return redirect()->route('prodi.index');
    }

    public function edit(Prodi $prodi)
    {
        return view('prodi.edit',compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $this->validate($request, [
            'nama_prodi' => 'required',
        ]);

        $prodi->update($request->all());
        Alert::toast('Data Prodi berhasil diedit','success');
        return redirect()->route('prodi.index');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        Alert::toast('Prodi '. $prodi->nama_prodi.' berhasil dihapus','success');
        return redirect()->route('prodi.index');
    }
}
