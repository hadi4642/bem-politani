<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DivisiController extends Controller
{

    public function index()
    {
        $divisis = Divisi::all();
        return view('divisi.index', compact('divisis'));
    }

    public function create()
    {
        return view('divisi.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_divisi' => 'required',
        ]);

        Divisi::create($request->all());
        Alert::toast('Divisi '. $request->nama_divisi.' berhasil ditambah','success');
        return redirect()->route('divisi.index');
    }

    public function edit(Divisi $divisi)
    {
        return view('divisi.edit',compact('divisi'));
    }

    public function update(Request $request, Divisi $divisi)
    {
        $this->validate($request, [
            'nama_divisi' => 'required',
        ]);

        $divisi->update($request->all());
        Alert::toast('Data Divisi berhasil diedit','success');
        return redirect()->route('divisi.index');
    }

    public function destroy(Divisi $divisi)
    {
        $divisi->delete();
        Alert::toast('Divisi '. $divisi->nama_divisi.' berhasil dihapus','success');
        return redirect()->route('divisi.index');
    }
}
