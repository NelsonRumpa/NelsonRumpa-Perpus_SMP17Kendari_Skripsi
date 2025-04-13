<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\kunjungan;
use App\Models\buku;

class kunjunganSiswaController extends Controller
{
    public function index()
    {
        $kunjungan = \App\Models\kunjungan::with('siswa')->get();
        $buku = \App\Models\buku::all();
        $siswa = \App\Models\siswa::all();
        return view('kunjunganSiswa.indexKunjS', compact('siswa','buku','kunjungan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kunjungan' => 'required',
            'siswa_ku' => 'required',
            'kelas' => 'required',
            'tujuan' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $kunjungan = new kunjungan();
            $kunjungan->id_kunjungan = $request->id_kunjungan;
            $kunjungan->siswa_ku = $request->siswa_ku;
            $kunjungan->kelas = $request->kelas;
            $kunjungan->tujuan = $request->tujuan;
            $kunjungan->buku_ku = $request->buku_ku;
            $kunjungan->keterangan = $request->keterangan;
            $kunjungan->save();

            DB::commit();
            return redirect('kunjunganSiswa')->with('success', 'Kunjungan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id_kunjungan)
    {
        $kunjungan = \App\Models\kunjungan::find($id_kunjungan);
        $buku = \App\Models\buku::all();
        $siswa = \App\Models\siswa::all();
        return view('kunjunganSiswa.editKunjS', compact('kunjungan', 'buku', 'siswa'));
    }

    public function update(Request $request, $id_kunjungan)
    {
        $request->validate([
            'siswa_ku' => 'required',
            'kelas' => 'required',
            'tujuan' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $kunjungan = kunjungan::findOrFail($id_kunjungan);
            $kunjungan->siswa_ku = $request->siswa_ku;
            $kunjungan->kelas = $request->kelas;
            $kunjungan->tujuan = $request->tujuan;
            $kunjungan->buku_ku = $request->buku_ku;
            $kunjungan->keterangan = $request->keterangan;
            $kunjungan->save();
            DB::commit();
            return redirect('kunjunganSiswa')->with('success', 'Data kunjungan berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id_kunjungan)
    {
        $kunjungan = \App\Models\kunjungan::find($id_kunjungan);
        $kunjungan->delete();

        return redirect('kunjunganSiswa')->with('success', 'Data kunjungan berhasil dihapus');
    }

    public function deleteAll()
    {
        try {
            DB::beginTransaction();

            \App\Models\kunjungan::query()->delete();

            DB::commit();

            return redirect('kunjunganSiswa')->with('success', 'Semua data Pengunjung berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('kunjunganSiswa')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
