<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Barang;


class BarangController extends Controller
{
    public function tampilBarang() {
        $barang = Barang::all();

        return view('pages.barang.barang', compact('barang'));
    }

    public function tambahBarang() {
        return view('pages.barang.add_barang');
    }

    function tambahBarangProcess(Request $request) {
        $nama_barang = $request->input('nama');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        // $foto = $request->file('foto');

        // if ($foto) {
        //     $thumb = $foto->getClientOriginalName();
        //     $path = public_path() . '/img';

        //     if (!File::exists($path)) {
        //         File::makeDirectory($path, 0777, true, true);
        //     }

        //     $foto->move($path, $thumb);
        // } else {
        //     $thumb = null;
        // }

        $barang = new Barang();

        $barang->nama_barang = $nama_barang;
        $barang->harga_barang = $harga;
        $barang->stock = $stok;
        // $barang->foto = $thumb;
        $barang->save();

        if ($barang) {
            return redirect('/admin/barang');
        } else {
            echo "Barang gagal ditambahkan";
            return redirect('/admin/barang');
        }
    }

    public function editBarang($id_barang) {
        $barang = Barang::where('id_barang', $id_barang)->first();

        return view('pages.barang.edit_barang', compact('barang'));
    }

    function editBarangProcess(Request $request) {
        $id_barang = $request->input('id_barang');
        $nama_barang = $request->input('nama');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        // $foto = $request->file('foto');

        // $path = public_path() . '/img';

        $query = Barang::where('id_barang', $id_barang)->first();

        // $foto_lama = $query->foto;
        // $thumb = $foto_lama;

        // if ($foto) {
        //     $thumb = $foto->getClientOriginalName();

        //     if ($query->foto) {
        //         File::delete($path . '/' . $foto_lama);
        //     }

        //     $foto->move($$path, $thumb);
        //     $query->foto = $thumb;
        // }

        $query->nama_barang = $nama_barang;
        $query->harga_barang = $harga;
        $query->stock = $stok;
        $query->save();

        if ($query) {
            return redirect('/admin/barang');
        } else {
            echo "Barang gagal diedit";
            return redirect('/admin/barang');
        }
    }

    function hapusBarang(Request $request) {
        $id_barang = $request->input('id_barang');
        $barang = Barang::where('id_barang', $id_barang)->first();

        if ($barang) {
            $barang->delete();
            return redirect('/admin/barang');
        } else {
            echo "Barang tidak ada";
            return redirect('/admin/barang');
        }
    }

    public function updateStock($id_barang, $jumlah)
    {
        $barang = Barang::where('id_barang', $id_barang)->first();
        if ($barang) {
            // Pastikan stok tidak menjadi negatif
            $newStock = max(0, $barang->stock - $jumlah);
            $barang->stock = $newStock;
            $barang->save();
            return true;
        }
        return false;
    }
}
