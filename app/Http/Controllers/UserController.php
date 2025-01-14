<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\User;

class UserController extends Controller
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

    function hapusPelanggan(Request $request) {
        $id_pelanggan = $request->input('id_pelanggan');
        $pelanggan = Pelanggan::where('id_pelanggan', $id_pelanggan)->first();

        if ($pelanggan) {
            $pelanggan->delete();
            return redirect('/admin/pelanggan');
        } else {
            echo "Pelanggan tidak ada";
            return redirect('/admin/pelanggan');
        }
    }

    public function tampilPelanggan() {
        $pelanggan = Pelanggan::all();

        return view('pages.admin.pelanggan', compact('pelanggan'));
    }

    public function tampilPegawai() {
        $pegawai = User::all();

        return view('pages.pegawai.pegawai', compact('pegawai'));
    }

    function hapusPegawai(Request $request) {
        $id_pegawai = $request->input('id_pegawai');
        $pegawai = User::where('id_user', $id_pegawai)->first();

        if ($pegawai) {
            $pegawai->delete();
            return redirect('/admin/pegawai');
        } else {
            echo "Pelanggan tidak ada";
            return redirect('/admin/pegawai');
        }
    }
}
