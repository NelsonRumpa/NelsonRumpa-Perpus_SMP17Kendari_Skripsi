<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\peminjaman;
use App\Models\dtl_peminjaman;
use App\Models\buku; 

class peminguruController extends Controller
{
    public function index()
    {
        $peminjaman = \App\Models\peminjaman::with('guru', 'details.buku')->get();
        $buku = \App\Models\buku::all();
        $guru = \App\Models\guru::all();
        return view('peminguru.indexPemG', compact('guru','buku','peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'guru_id' => 'required',
            'tgl_pinjam' => 'required|date',
            'buku_id' => 'required|array',
            'buku_id.*' => 'required|exists:buku,id_buku',
            'status' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $peminjaman = new peminjaman();
            $peminjaman->id_peminjaman = $request->id_peminjaman;
            $peminjaman->guru_id = $request->guru_id;
            $peminjaman->tgl_pinjam = $request->tgl_pinjam;
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
            return redirect('peminGuru')->with('success', 'Peminjaman berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id_peminjaman)
    {
        $peminjaman = \App\Models\peminjaman::with('details.buku')->find($id_peminjaman);
        $buku = \App\Models\buku::all();
        $guru = \App\Models\guru::all();
        return view('peminGuru.editPemG', compact('peminjaman', 'buku', 'guru'));
    }

    public function update(Request $request, $id_peminjaman)
    {
        $request->validate([
            'guru_id' => 'required',
            'tgl_pinjam' => 'required|date',
            'buku_id' => 'required|array',
            'buku_id.*' => 'required|exists:buku,id_buku',
        ]);

        DB::beginTransaction();

        try {
            $peminjaman = peminjaman::findOrFail($id_peminjaman);
            $oldBukuIds = $peminjaman->details->pluck('buku_id')->toArray();

            $peminjaman->guru_id = $request->guru_id;
            $peminjaman->tgl_pinjam = $request->tgl_pinjam;
            $peminjaman->keterangan = $request->keterangan;
            $peminjaman->save();

            $peminjaman->details()->delete();

            foreach ($request->buku_id as $bukuId) {
                $detail = new dtl_peminjaman();
                $detail->peminjaman_id = $peminjaman->id_peminjaman;
                $detail->buku_id = $bukuId;
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
            return redirect('peminGuru')->with('success', 'Data peminjaman berhasil diupdate');
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
            return redirect('peminGuru')->with('success', 'Buku berhasil dikembalikan');
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

        return redirect('peminGuru')->with('success', 'Data peminjaman berhasil dihapus');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect('peminGuru')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
    }
}

    public function deleteAll()
    {
        try {
            DB::beginTransaction();

            \App\Models\dtl_peminjaman::query()->delete();

            \App\Models\peminjaman::query()->delete();

            DB::commit();

            return redirect('peminGuru')->with('success', 'Semua data peminjaman berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('peminGuru')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
