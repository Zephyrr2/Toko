<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\User;

class UserController extends Controller
{
    function tambahPelangganProcess (Request $request) {
        $id_pelanggan = $request->input('id_pelanggan');
        $nama = $request->input('nama');
        $gender = $request->input('gender');

        $pelanggan = new Pelanggan();

        $pelanggan->id_pelanggan = $id_pelanggan;
        $pelanggan->nama = $nama;
        $pelanggan->gender = $gender;
        $pelanggan->save();

        return redirect('/admin/pelanggan');
    }

    public function tambahPelanggan() {
        return view('pages.admin.add_pelanggan');
    }

    public function editPelanggan($id_pelanggan) {
        $pelanggan = Pelanggan::where('id_pelanggan', $id_pelanggan)->first();

        return view('pages.admin.edit_pelanggan', compact('pelanggan'));
    }

    public function editPelangganProcess(Request $request) {
        $id_pelanggan = $request->input('id_pelanggan');
        $id_member = $request->input('id_member');
        $nama = $request->input('nama');
        $gender = $request->input('gender');

        $query = Pelanggan::where('id_pelanggan', $id_pelanggan)->first();

        $query->id_pelanggan = $id_member;
        $query->nama = $nama;
        $query->gender = $gender;
        $query->save();

        if ($query) {
            return redirect('/admin/pelanggan');
        } else {
            echo "Member failed to edit";
            return redirect('/admin/pelanggan');
        }
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

    public function editPegawai($id_pegawai) {
        $pegawai = User::where('id_user', $id_pegawai)->first();

        return view('pages.pegawai.edit_pegawai', compact('pegawai'));
    }

    public function editPegawaiProcess(Request $request) {
        $id_pegawai = $request->input('id_pegawai');
        $username = $request->input('username');
        $email = $request->input('email');
        $role = $request->input('role');

        $query = User::where('id_user', $id_pegawai)->first();

        $query->username = $username;
        $query->email = $email;
        $query->role = $role;
        $query->save();

        if ($query) {
            return redirect('/admin/pegawai');
        } else {
            echo "Pegawai failed to edit";
            return redirect('/admin/pegawai');
        }
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
