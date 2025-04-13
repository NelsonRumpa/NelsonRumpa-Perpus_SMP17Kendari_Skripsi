<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use App\Models\dtl_peminjaman;
use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class peminKelasController extends Controller
{
    public function index()
    {
        $peminjaman = \App\Models\peminjaman::with('details.buku')->get();
        $buku = \App\Models\buku::all();
        return view('peminKelas.indexPemK', compact('buku','peminjaman'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_peminjaman' => 'required',
        'kelas' => 'required',
        'tgl_pinjam' => 'required|date',
        'keterangan' => 'required',
        'buku_id' => 'required|array',
        'buku_id.*' => 'required|exists:buku,id_buku',
        'jumlah' => 'required|array',
        'jumlah.*' => 'required|integer|min:1',
        'status' => 'required',
    ]);

    DB::beginTransaction();

    try {
        $peminjaman = new peminjaman();
        $peminjaman->id_peminjaman = $request->id_peminjaman;
        $peminjaman->kelas = $request->kelas;
        $peminjaman->tgl_pinjam = $request->tgl_pinjam;
        $peminjaman->keterangan = $request->keterangan;
        $peminjaman->status = $request->status;
        $peminjaman->save();

        foreach ($request->buku_id as $index => $bukuid) {
            $jumlahPinjam = $request->jumlah[$index];

            $detail = new dtl_peminjaman();
            $detail->peminjaman_id = $peminjaman->id_peminjaman;
            $detail->buku_id = $bukuid;
            $detail->jumlah = $jumlahPinjam;
            $detail->save();

            $buku = buku::findOrFail($bukuid);
            if ($buku->jumlah >= $jumlahPinjam) {
                $buku->jumlah -= $jumlahPinjam;
                $buku->save();
            } else {
                throw new \Exception("Stok buku {$buku->judul} tidak mencukupi.");
            }
        }

        DB::commit();
        return redirect('peminKelas')->with('success', 'Peminjaman berhasil ditambahkan.');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function edit($id_peminjaman)
    {
        $peminjaman = \App\Models\peminjaman::with('details.buku')->find($id_peminjaman);
        $buku = \App\Models\buku::all();
        return view('peminKelas.editPemK', compact('peminjaman', 'buku'));
    }

    public function update(Request $request, $id_peminjaman)
{
    $request->validate([
        'kelas' => 'required',
        'tgl_pinjam' => 'required|date',
        'keterangan' => 'required',
        'jumlah' => 'required|array',
        'jumlah.*' => 'required|integer|min:1',
        'buku_id' => 'required|array',
        'buku_id.*' => 'required|exists:buku,id_buku',
    ]);

    DB::beginTransaction();

    try {
        $peminjaman = peminjaman::findOrFail($id_peminjaman);
        $oldDetails = $peminjaman->details;

        $peminjaman->kelas = $request->kelas;
        $peminjaman->tgl_pinjam = $request->tgl_pinjam;
        $peminjaman->keterangan = $request->keterangan;
        $peminjaman->save();

        foreach ($oldDetails as $oldDetail) {
            $buku = buku::findOrFail($oldDetail->buku_id);
            $buku->jumlah += $oldDetail->jumlah;
            $buku->save();
        }

        $peminjaman->details()->delete();

        foreach ($request->buku_id as $index => $bukuId) {
            $jumlahPinjam = $request->jumlah[$index];

            $detail = new dtl_peminjaman();
            $detail->peminjaman_id = $peminjaman->id_peminjaman;
            $detail->buku_id = $bukuId;
            $detail->jumlah = $jumlahPinjam;
            $detail->save();

            $buku = buku::findOrFail($bukuId);
            if ($buku->jumlah >= $jumlahPinjam) {
                $buku->jumlah -= $jumlahPinjam;
                $buku->save();
            } else {
                throw new \Exception("Stok buku {$buku->judul} tidak mencukupi.");
            }
        }

        DB::commit();
        return redirect('peminKelas')->with('success', 'Data peminjaman berhasil diupdate');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function return(Request $request, $id_peminjaman)
{
    DB::beginTransaction();

    try {
        $peminjaman = peminjaman::findOrFail($id_peminjaman);

        if ($peminjaman->status !== 'Dipinjam') {
            throw new \Exception("Peminjaman sudah dikembalikan atau tidak valid.");
        }

        foreach ($peminjaman->details as $detail) {
            $buku = buku::findOrFail($detail->buku_id);

            $buku->jumlah += $detail->jumlah;
            $buku->save();
        }

        $peminjaman->status = 'Dikembalikan';
        $peminjaman->save();

        DB::commit();
        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function destroy($id_peminjaman)
    {
        DB::beginTransaction();

        try {
            $peminjaman = \App\Models\peminjaman::findOrFail($id_peminjaman);

            if ($peminjaman->status === 'Dipinjam') {
            foreach ($peminjaman->details as $detail) {
                $buku = $detail->buku_id;
                $buku->jumlah += $detail->jumlah;
                $buku->save();
            }
        }

            $peminjaman->details()->delete();

            $peminjaman->delete();

            DB::commit();
            return redirect('peminKelas')->with('success', 'Data peminjaman berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('peminKelas')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
