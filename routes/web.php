<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;


Route::middleware('guest')->group(function(){
    Route::post('/login/process', [AuthController::class, 'loginProcess']);
    Route::get('/', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function (){

    Route::post('/logout', [AuthController::class, 'logout']);

    //pelanggan
    Route::get('/admin/pelanggan', [UserController::class, 'tampilPelanggan']);
    Route::post('/admin/pelanggan/add/process', [UserController::class, 'tambahPelangganProcess']);
    Route::get('/admin/pelanggan/edit/{id_pelanggan}', [UserController::class, 'editPelanggan']);
    Route::post('/admin/pelanggan/edit/process', [UserController::class, 'editPelangganProcess']);
    Route::post('/register/process', [AuthController::class, 'registerProcess']);
    Route::get('/register/pegawai', [AuthController::class, 'registerPegawai']);
    Route::get('/admin/pelanggan/add', [UserController::class, 'tambahPelanggan']);
    Route::delete('/admin/pelanggan/delete', [UserController::class, 'hapusPelanggan']);

    //transaksi
    Route::get('/admin/transaksi', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/admin/transaksi', [TransaksiController::class, 'store'])->name('simpanTransaksi');
    Route::get('/barang/{id_barang}', [TransaksiController::class, 'getBarang'])->name('getBarang');


    Route::get('/admin/invoice', [TransaksiController::class, 'tampilPenjualan']);
    Route::get('/admin/invoice/detail/{id}', [TransaksiController::class, 'tampilDetailPenjualan'])->name('tampilDetailPenjualan');


    Route::get('/admin/laporan',[TransaksiController::class,'laporan']);
    Route::get('/admin/filter-laporan',[TransaksiController::class,'filterLaporan']);

    Route::middleware('role:Admin')->group(function(){
        //pegawai
        Route::get('/admin/pegawai', [UserController::class, 'tampilPegawai']);
        Route::get('/admin/pegawai/edit/{id_pegawai}', [UserController::class, 'editPegawai']);
        Route::post('/admin/pegawai/edit/process', [UserController::class, 'editPegawaiProcess']);
        Route::delete('/admin/pegawai/delete', [UserController::class, 'hapusPegawai']);

        //barang
        Route::get('/admin/barang', [BarangController::class, 'tampilBarang']);
        Route::get('/admin/barang/add', [BarangController::class, 'tambahBarang']);
        Route::post('/admin/barang/add/process', [BarangController::class, 'tambahBarangProcess']);
        Route::get('/admin/barang/edit/{id_barang}', [BarangController::class, 'editBarang']);
        Route::post('/admin/barang/edit/process', [BarangController::class, 'editBarangProcess']);
        Route::delete('/admin/barang/delete', [BarangController::class, 'hapusBarang']);
        Route::post('/admin/barang/update-stock/{id_barang}', [BarangController::class, 'updateStock'])->name('barang.updateStock');

    });

    // Tambahkan route ini di dalam middleware auth
    Route::get('/cek-pelanggan/{id_pelanggan}', function($id_pelanggan) {
        $pelanggan = \App\Models\Pelanggan::find($id_pelanggan);
        return response()->json([
            'status' => $pelanggan ? 'member' : 'non-member'
        ]);
    });
});
