<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function index()
    {
        $kategori = \App\Models\kategori::all();
        return view('kategori.indexKat', compact('kategori'));
    }
    
    public function store(Request $request)
    {
        \App\Models\kategori::create($request->all());

        return redirect ('kategori');
    }

    public function edit($id_kat)
    {
        $kategori = \App\Models\kategori::find($id_kat);
        return view('kategori.editKat', compact('kategori'));
    }

    public function update(Request $request, $id_kat)
    {
    $kategori = \App\Models\kategori::find($id_kat);

    $kategori->id_kat = $request->id_kat;
    $kategori->nama = $request->nama;
    $kategori->update();

    return redirect('kategori')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id_kat)
    {
        $kategori = \App\Models\kategori::find($id_kat);
        $kategori->delete();

        return redirect('kategori');
    }
}
