<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::post('/register/process', [AuthController::class, 'registerProcess']);
Route::get('/register/pegawai', [AuthController::class, 'registerPegawai']);
Route::post('/login/process', [AuthController::class, 'loginProcess']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//pelanggan
Route::get('/admin/pelanggan', [HomeController::class, 'tampilPelanggan']);
Route::post('/admin/pelanggan/add/process', [HomeController::class, 'tambahPelangganProcess']);
Route::get('/admin/pelanggan/add', [HomeController::class, 'tambahPelanggan']);

//pegawai
Route::get('/admin/pegawai', [HomeController::class, 'tampilPegawai']);
