<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\siswa;
use Illuminate\Support\Facades\DB; 

class dashboardController extends Controller
{
    public function index()
{
    // Mengambil data peminjaman per bulan dan per tahun untuk siswa, guru, dan kelas dalam satu query
    $peminjaman = DB::table('peminjaman')
        ->select(
            DB::raw('YEAR(tgl_pinjam) as tahun'),
            DB::raw('MONTH(tgl_pinjam) as bulan'),
            DB::raw('COUNT(siswa_id) as total_siswa'),
            DB::raw('COUNT(guru_id) as total_guru'),
            DB::raw('COUNT(kelas) as total_kelas')
        )
        ->groupBy('tahun', 'bulan')
        ->get();

    $combinedData = [];

    // Mendapatkan semua tahun yang tersedia
    $allTahun = $peminjaman->pluck('tahun')->unique()->sort();

    // Iterasi untuk setiap tahun dan bulan untuk menggabungkan data
    foreach ($allTahun as $tahun) {
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $record = $peminjaman->where('tahun', $tahun)->where('bulan', $bulan)->first();

            $combinedData[] = [
                'tahun' => $tahun,
                'bulan' => $bulan,
                'siswa' => $record ? $record->total_siswa : 0,
                'guru' => $record ? $record->total_guru : 0,
                'kelas' => $record ? $record->total_kelas : 0,
            ];
        }
    }

    // Mengorganisir data berdasarkan tahun
    $yearlyData = [];

    foreach ($combinedData as $data) {
        $tahun = $data['tahun'];
        if (!isset($yearlyData[$tahun])) {
            $yearlyData[$tahun] = [
                'siswa' => array_fill(0, 12, 0),
                'guru' => array_fill(0, 12, 0),
                'kelas' => array_fill(0, 12, 0),
            ];
        }
        $bulanIndex = $data['bulan'] - 1; // Indeks array mulai dari 0
        $yearlyData[$tahun]['siswa'][$bulanIndex] = $data['siswa'];
        $yearlyData[$tahun]['guru'][$bulanIndex] = $data['guru'];
        $yearlyData[$tahun]['kelas'][$bulanIndex] = $data['kelas'];
    }

    // Menyiapkan data untuk frontend
    $frontendData = [];
    foreach ($yearlyData as $tahun => $data) {
        $frontendData[] = [
            'tahun' => $tahun,
            'siswa' => $data['siswa'],
            'guru' => $data['guru'],
            'kelas' => $data['kelas'],
        ];
    }

    // Mengambil data kunjungan
    $kunjungan = DB::table('kunjungan')
        ->select(DB::raw('COALESCE(COUNT(kunjungan.id_kunjungan), 0) as jumlah'))
        ->first();

    $buku = DB::table('buku')
    ->select(DB::raw('COALESCE(sum(buku.jumlah), 0) as jumlah'))
    ->first();

    // Mengirim data ke view
    return view('dashboard', compact('frontendData', 'kunjungan','buku'));
}

    

}
