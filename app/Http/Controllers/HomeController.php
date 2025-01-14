<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\User;

class HomeController extends Controller
{
    function tambahPelangganProcess (Request $request) {
        $nama = $request->input('nama');
        $gender = $request->input('gender');

        $pelanggan = new Pelanggan();

        $pelanggan->nama = $nama;
        $pelanggan->gender = $gender;
        $pelanggan->save();

        return redirect('/admin/pelanggan');
    }

    public function tambahPelanggan() {
        return view('pages.admin.add_pelanggan');
    }

    public function tampilPelanggan() {
        $pelanggan = Pelanggan::all();

        return view('pages.admin.pelanggan', compact('pelanggan'));
    }

    public function tampilPegawai() {
        $pegawai = User::all();

        return view('pages.pegawai.pegawai', compact('pegawai'));
    }
}
