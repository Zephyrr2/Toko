<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Models\Barang;

Route::post('/login/process', [AuthController::class, 'loginProcess']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//pelanggan
Route::get('/admin/pelanggan', [UserController::class, 'tampilPelanggan']);
Route::post('/admin/pelanggan/add/process', [UserController::class, 'tambahPelangganProcess']);
Route::get('/admin/pelanggan/add', [UserController::class, 'tambahPelanggan']);
Route::delete('/admin/pelanggan/delete', [UserController::class, 'hapusPelanggan']);

//pegawai
Route::get('/admin/pegawai', [UserController::class, 'tampilPegawai']);
Route::post('/register/process', [AuthController::class, 'registerProcess']);
Route::get('/register/pegawai', [AuthController::class, 'registerPegawai']);
Route::delete('/admin/pegawai/delete', [UserController::class, 'hapusPegawai']);

//barang
Route::get('/admin/barang', [BarangController::class, 'tampilBarang']);
Route::get('/admin/barang/add', [BarangController::class, 'tambahBarang']);
Route::post('/admin/barang/add/process', [BarangController::class, 'tambahBarangProcess']);
Route::get('/admin/barang/edit/{id_barang}', [BarangController::class, 'editBarang']);
Route::post('/admin/barang/edit/process', [BarangController::class, 'editBarangProcess']);
Route::delete('/admin/barang/delete', [BarangController::class, 'hapusBarang']);
