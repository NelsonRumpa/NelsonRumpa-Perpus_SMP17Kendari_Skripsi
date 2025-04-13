<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\siswa;

class siswaController extends Controller
{
    public function index()
    {
        $siswa = \App\Models\siswa::all();
        return view('siswa.indexsis', compact('siswa'));
    }

    public function store(Request $request)
    {
        $lastSiswa = \App\Models\siswa::max(DB::raw("CAST(SUBSTRING(id_siswa, 3) AS UNSIGNED)"));
    
        if (!$lastSiswa) {
            $id_siswa = 'S-0000001';
        } else {
            $id_siswa = 'S-' . str_pad($lastSiswa + 1, 7, '0', STR_PAD_LEFT);
        }
    
        $requestData = $request->all();
        $requestData['id_siswa'] = $id_siswa;
    
        \App\Models\siswa::create($requestData);
    
        return redirect('siswa');
    }

    public function edit($id_siswa)
    {
        $siswa = \App\Models\siswa::find($id_siswa);
        return view('siswa.editsis', compact('siswa'));
    }

    public function update(Request $request, $id_siswa)
    {
    $siswa = \App\Models\siswa::find($id_siswa);

    $siswa->nama = $request->nama;
    $siswa->jenis_kelamin = $request->jenis_kelamin;
    $siswa->alamat = $request->alamat;
    $siswa->update();

    return redirect('siswa')->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy($id_siswa)
    {
        $siswa = \App\Models\siswa::find($id_siswa);
        $siswa->delete();

        return redirect('siswa');
    }

    
}
