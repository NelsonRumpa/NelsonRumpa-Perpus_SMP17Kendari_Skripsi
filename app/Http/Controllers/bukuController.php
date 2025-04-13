<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buku;
use Illuminate\Support\Facades\Storage;

class bukuController extends Controller
{
    public function index()
    {
        $buku = \App\Models\buku::all();
        $kategori = \App\Models\kategori::all();
        $rakbuku = \App\Models\rakbuku::all();
       
        return view('buku.indexBuku', compact('buku','kategori','rakbuku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kategori_id' => 'required',
            'rak_id' => 'required',
            'jumlah' => 'required',
            'penulis' => 'required',
            'ISBN' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $coverPath = $request->file('cover')->store('public/cover');
        $coverUrl = asset('storage/' . str_replace('public/', '', $coverPath));

        $buku = new buku;
        $buku->judul = $request->judul;
        $buku->cover = $coverUrl;
        $buku->kategori_id = $request->kategori_id;
        $buku->rak_id = $request->rak_id;
        $buku->jumlah = $request->jumlah;
        $buku->penulis = $request->penulis;
        $buku->ISBN = $request->ISBN;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->save();

        return redirect()->back();
    }

    public function edit($id_buku)
    {
        $buku = \App\Models\buku::find($id_buku);
        $kategori = \App\Models\kategori::all();
        $rakbuku = \App\Models\rakbuku::all();
        return view('buku.editBuku', compact('buku','kategori','rakbuku'));
    }


    public function update(Request $request, $id_buku)
    {
        $request->validate([
            'judul' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif',
            'kategori_id' => 'required',
            'rak_id' => 'required',
            'jumlah' => 'required|integer',
            'penulis' => 'required',
            'ISBN' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $buku = \App\Models\buku::find($id_buku);

        $perubahanJumlah = $request->jumlah - $buku->jumlah;

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                $oldCoverPath = str_replace(asset('storage'), 'public', $buku->cover);
                Storage::delete($oldCoverPath);
            }
        
            $coverPath = $request->file('cover')->store('public/cover');
            $coverUrl = asset('storage/' . str_replace('public/', '', $coverPath));
            $buku->cover = $coverUrl;
        }
        

        $buku->judul = $request->judul;
        $buku->rak_id = $request->rak_id;
        $buku->jumlah += $perubahanJumlah;
        $buku->kategori_id = $request->kategori_id;
        $buku->penulis = $request->penulis;
        $buku->ISBN = $request->ISBN;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        
        $buku->save();

        return redirect('buku')->with('success', 'Buku berhasil diupdate. Perubahan jumlah: ' . $perubahanJumlah);
    }


    public function destroy($id_buku)
    {
        $buku = \App\Models\Buku::find($id_buku);
        $buku->delete();

        return redirect('buku');
    }
}
