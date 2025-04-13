<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use App\Models\dtl_peminjaman;
use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  

class peminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = \App\Models\peminjaman::with('siswa', 'details.buku')->get();
        $buku = \App\Models\buku::all();
        $siswa = \App\Models\siswa::all();
        return view('peminjaman.indexPem', compact('siswa', 'buku', 'peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'siswa_id' => 'required',
            'tgl_pinjam' => 'required|date',
            'durasi_pinjam' => 'required',
            'tgl_kembali' => 'required|date',
            'buku_id' => 'required|array',
            'buku_id.*' => 'required|exists:buku,id_buku',
            'status' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $peminjaman = new peminjaman();
            $peminjaman->id_peminjaman = $request->id_peminjaman;
            $peminjaman->siswa_id = $request->siswa_id;
            $peminjaman->tgl_pinjam = $request->tgl_pinjam;
            $peminjaman->tgl_kembali = $request->tgl_kembali;
            $peminjaman->keterangan = $request->keterangan;
            $peminjaman->status = $request->status;
            $peminjaman->save();

            foreach ($request->buku_id as $bukuid) {
                $detail = new dtl_peminjaman();
                $detail->peminjaman_id = $peminjaman->id_peminjaman;
                $detail->buku_id = $bukuid;
                $detail->save();

                $buku = buku::findOrFail($bukuid);
                if ($buku->jumlah > 0) {
                    $buku->jumlah -= 1;
                    $buku->save();
                } else {
                    throw new \Exception("Stok buku {$buku->judul} habis.");
                }
            }

            DB::commit();
            return redirect('peminjaman')->with('success', 'Peminjaman berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id_peminjaman)
{
    DB::beginTransaction();

    try {
        $peminjaman = \App\Models\Peminjaman::findOrFail($id_peminjaman);

        if ($peminjaman->status === 'Dipinjam') {
            foreach ($peminjaman->details as $detail) {
                $buku = $detail->buku;
                $buku->jumlah += 1;
                $buku->save();
            }
        }

        $peminjaman->details()->delete();

        $peminjaman->delete();

        DB::commit();

        return redirect('peminjaman')->with('success', 'Data peminjaman berhasil dihapus');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect('peminjaman')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
    }
}


    public function edit($id_peminjaman)
    {
        $peminjaman = \App\Models\peminjaman::with('details.buku')->find($id_peminjaman);
        $buku = \App\Models\buku::all();
        $siswa = \App\Models\siswa::all();
        return view('peminjaman.editPem', compact('peminjaman', 'buku', 'siswa'));
    }

    public function update(Request $request, $id_peminjaman)
    {
        $request->validate([
            'siswa_id' => 'required',
            'tgl_pinjam' => 'required|date',
            'durasi_pinjam' => 'required|in:3,365',
            'tgl_kembali' => 'required|date',
            'buku_id' => 'required|array',
            'buku_id.*' => 'required|exists:buku,id_buku',
        ]);

        DB::beginTransaction();

        try {
            $peminjaman = peminjaman::findOrFail($id_peminjaman);
            $oldBukuIds = $peminjaman->details->pluck('buku_id')->toArray();

            $peminjaman->siswa_id = $request->siswa_id;
            $peminjaman->tgl_pinjam = $request->tgl_pinjam;
            $peminjaman->tgl_kembali = $request->tgl_kembali;
            $peminjaman->keterangan = $request->keterangan;
            $peminjaman->save();

            $peminjaman->details()->delete();

            $returnedBooks = $request->is_returned ?? [];

            foreach ($request->buku_id as $bukuId) {
                $detail = new dtl_peminjaman();
                $detail->peminjaman_id = $peminjaman->id_peminjaman;
                $detail->buku_id = $bukuId;
                $detail->is_returned = in_array($bukuId, $returnedBooks);
                $detail->save();
            }

            $newBukuIds = $request->buku_id;
            $bukuToDecrease = array_diff($newBukuIds, $oldBukuIds);
            $bukuToIncrease = array_diff($oldBukuIds, $newBukuIds);

            foreach ($bukuToDecrease as $bukuId) {
                $buku = buku::findOrFail($bukuId);
                $buku->jumlah -= 1;
                $buku->save();
            }

            foreach ($bukuToIncrease as $bukuId) {
                $buku = buku::findOrFail($bukuId);
                $buku->jumlah += 1;
                $buku->save();
            }

            DB::commit();
            return redirect('peminjaman')->with('success', 'Data peminjaman berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function returnBook($id_peminjaman)
    {
        DB::beginTransaction();

        try {
            $peminjaman = peminjaman::findOrFail($id_peminjaman);
            $peminjaman->status = 'Dikembalikan';
            $peminjaman->save();

            foreach ($peminjaman->details as $detail) {
                $buku = $detail->buku;
                $buku->jumlah += 1;
                $buku->save();
            }

            DB::commit();
            return redirect('peminjaman')->with('success', 'Buku berhasil dikembalikan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
