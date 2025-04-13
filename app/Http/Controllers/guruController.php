<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class guruController extends Controller
{
    public function index()
    {
        $guru = \App\Models\guru::all();
        return view('guru.indexguru', compact('guru'));
    }

    public function store(Request $request)
    {
        $lastguru = \App\Models\guru::max(DB::raw("CAST(SUBSTRING(id_guru, 3) AS UNSIGNED)"));
    
        if (!$lastguru) {
            $id_guru = 'G-0000001';
        } else {
            $id_guru = 'G-' . str_pad($lastguru + 1, 7, '0', STR_PAD_LEFT);
        }
    
        $requestData = $request->all();
        $requestData['id_guru'] = $id_guru;
    
        \App\Models\guru::create($requestData);
    
        return redirect('guru');
    }

    public function edit($id_guru)
    {
        $guru = \App\Models\guru::find($id_guru);
        return view('guru.editguru', compact('guru'));
    }

    public function update(Request $request, $id_guru)
    {
    $guru = \App\Models\guru::find($id_guru);

    $guru->nama = $request->nama;
    $guru->update();

    return redirect('guru');
    }

    public function destroy($id_guru)
    {
        $guru = \App\Models\guru::find($id_guru);
        $guru->delete();

        return redirect('guru');
    }
}
