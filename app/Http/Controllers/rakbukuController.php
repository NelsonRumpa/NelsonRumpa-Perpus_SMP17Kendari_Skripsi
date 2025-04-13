<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class rakbukuController extends Controller
{
    public function index()
    {
        $rakbuku = \App\Models\rakbuku::all();
        return view('rakbuku.indexRak', compact('rakbuku'));
    }
    
    public function store(Request $request)
    {
        \App\Models\rakbuku::create($request->all());

        return redirect ('rakbuku');
    }

    public function edit($id_rak)
    {
        $rakbuku = \App\Models\rakbuku::find($id_rak);
        return view('rakbuku.editRak', compact('rakbuku'));
    }

    public function update(Request $request, $id_rak)
    {
    $rakbuku = \App\Models\rakbuku::find($id_rak);

    $rakbuku->id_rak = $request->id_rak;
    $rakbuku->lokasi = $request->lokasi;
    $rakbuku->update();

    return redirect('rakbuku');
    }

    public function destroy($id_rak)
    {
        $rakbuku = \App\Models\rakbuku::find($id_rak);
        $rakbuku->delete();

        return redirect('rakbuku');
    }
}
