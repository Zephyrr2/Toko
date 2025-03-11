<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\FuncCall;

class TransaksiController extends Controller
{
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $barang = Barang::all();
        $transaksi = Penjualan::all();
        return view('pages.admin.transaksi', compact('pelanggan', 'barang', 'transaksi'));
    }

    public function getBarang($id_barang)
    {
        $barang = Barang::find($id_barang);
        return response()->json($barang);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validasi request
            if (!$request->has('barang') || empty($request->barang)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada barang yang dipilih'
                ], 422);
            }

            // Filter barang dengan jumlah > 0
            $validBarang = array_filter($request->barang, function($item) {
                return isset($item['id_barang']) &&
                       !empty($item['id_barang']) &&
                       isset($item['jml_barang']) &&
                       $item['jml_barang'] > 0;
            });

            if (empty($validBarang)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada barang dengan jumlah valid'
                ], 422);
            }

            // Cek apakah pelanggan terdaftar
            $pelanggan = null;
            $isMember = false;
            if ($request->id_pelanggan) {
                $pelanggan = Pelanggan::find($request->id_pelanggan);
                $isMember = $pelanggan ? true : false;
            }

            // Simpan transaksi
            $penjualan = Penjualan::create([
                'id_pelanggan' => $request->id_pelanggan ?? null,
                'tgl_transaksi' => now(),
                'total_transaksi' => 0,
            ]);

            $totalHarga = 0;
            $items = [];

            foreach ($validBarang as $item) {
                $barang = Barang::find($item['id_barang']);

                if (!$barang) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Barang dengan ID ' . $item['id_barang'] . ' tidak ditemukan'
                    ], 422);
                }

                $subtotal = $barang->harga_barang * $item['jml_barang'];
                $totalHarga += $subtotal;

                // Simpan detail penjualan
                DetailPenjualan::create([
                    'id_transaksi' => $penjualan->id_transaksi,
                    'id_barang' => $barang->id_barang,
                    'jml_barang' => $item['jml_barang'],
                    'harga_satuan' => $barang->harga_barang,
                ]);

                // Tambahkan item ke array untuk response
                $items[] = [
                    'nama_barang' => $barang->nama_barang,
                    'jumlah' => $item['jml_barang'],
                    'harga_satuan' => $barang->harga_barang,
                ];
            }

            // Hitung diskon jika member
            $diskon = $isMember ? ($totalHarga * 0.1) : 0;
            $totalAkhir = $totalHarga - $diskon;

            // Update total transaksi
            $penjualan->update(['total_transaksi' => $totalAkhir]);

            // Update stok barang
            $barangController = new BarangController();
            foreach ($validBarang as $item) {
                $barangController->updateStock($item['id_barang'], $item['jml_barang']);
            }

            DB::commit();

            // Return response JSON untuk print invoice
            return response()->json([
                'success' => true,
                'id_transaksi' => $penjualan->id_transaksi,
                'nama_pelanggan' => $pelanggan ? $pelanggan->nama : 'Umum',
                'is_member' => $isMember,
                'items' => $items,
                'total' => $totalHarga,
                'diskon' => $diskon,
                'total_akhir' => $totalAkhir
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaksi error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function tampilPenjualan(){
        $penjualan = Penjualan::with(['pelangganRelasi'])->get();
        return view('pages.admin.penjualan', compact('penjualan'));
    }

    public function tampilDetailPenjualan($id){
        $penjualan = DetailPenjualan::with(['penjualanRelasi', 'barangRelasi'])
        ->where('id_transaksi', $id)
        ->get();

        // Ambil pelanggan terkait untuk memeriksa keanggotaan
        $penjualanData = Penjualan::with('pelangganRelasi')->find($id);
        $isMember = $penjualanData->pelangganRelasi ? true : false; // Cek apakah pelanggan adalah anggota

        return view('pages.admin.penjualan_detail', compact('penjualan', 'isMember'));
    }

    public function laporan(){
        $penjualan = Penjualan::with(['pelangganRelasi'])
                 ->orderBy('created_at', 'desc')
                 ->get();
        return view('pages.admin.laporan', compact('penjualan'));
    }

    public function filterLaporan(Request $request) {
        $startDate = $request->start_date ? $request->start_date . ' 00:00:00' : null;
        $endDate = $request->end_date ? $request->end_date . ' 23:59:59' : null;

        $penjualan = Penjualan::with(['pelangganRelasi']);

        if ($startDate && $endDate) {
            $penjualan->whereBetween('created_at', [$startDate, $endDate]);
        }

        $data = $penjualan->orderBy('created_at', 'desc')->get();

        return response()->json($data);
    }

    public function printInvoice($idTransaksi, $namaPelanggan, $isMember, $items, $total, $diskon, $totalAkhir)
    {
        return response()->json([
            'success' => true,
            'id_transaksi' => $idTransaksi,
            'nama_pelanggan' => $namaPelanggan,
            'is_member' => $isMember,
            'items' => $items,
            'total' => $total,
            'diskon' => $diskon,
            'total_akhir' => $totalAkhir
        ]);
    }
}

