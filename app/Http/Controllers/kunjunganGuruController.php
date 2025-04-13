<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\kunjungan;
use App\Models\buku;

class kunjunganGuruController extends Controller
{
    public function index()
    {
        $kunjungan = \App\Models\kunjungan::with('guru')->get();
        $buku = \App\Models\buku::all();
        $guru = \App\Models\guru::all();
        return view('kunjunganGuru.indexKunjG', compact('guru','buku','kunjungan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kunjungan' => 'required',
            'guru_ku' => 'required',
            'tujuan' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $kunjungan = new kunjungan();
            $kunjungan->id_kunjungan = $request->id_kunjungan;
            $kunjungan->guru_ku = $request->guru_ku;
            $kunjungan->tujuan = $request->tujuan;
            $kunjungan->buku_ku = $request->buku_ku;
            $kunjungan->keterangan = $request->keterangan;
            $kunjungan->save();

            DB::commit();
            return redirect('kunjunganGuru')->with('success', 'Kunjungan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id_kunjungan)
    {
        $kunjungan = \App\Models\kunjungan::find($id_kunjungan);
        $buku = \App\Models\buku::all();
        $guru = \App\Models\guru::all();
        return view('kunjunganGuru.editKunjG', compact('kunjungan', 'buku', 'guru'));
    }

    public function update(Request $request, $id_kunjungan)
    {
        $request->validate([
            'guru_ku' => 'required',
            'tujuan' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $kunjungan = kunjungan::findOrFail($id_kunjungan);
            $kunjungan->guru_ku = $request->guru_ku;
            $kunjungan->tujuan = $request->tujuan;
            $kunjungan->buku_ku = $request->buku_ku;
            $kunjungan->keterangan = $request->keterangan;
            $kunjungan->save();
            DB::commit();
            return redirect('kunjunganGuru')->with('success', 'Data kunjungan berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id_kunjungan)
    {
        $kunjungan = \App\Models\kunjungan::find($id_kunjungan);
        $kunjungan->delete();

        return redirect('kunjunganGuru')->with('success', 'Data kunjungan berhasil dihapus');
    }

    public function deleteAll()
    {
        try {
            DB::beginTransaction();

            \App\Models\kunjungan::query()->delete();

            DB::commit();

            return redirect('kunjunganGuru')->with('success', 'Semua data Pengunjung berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('kunjunganGuru')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
