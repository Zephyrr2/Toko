@extends('layouts.master')
@section('content')
    @include('partials.sidebar')
    <style>
        @media print {
            body * {
                visibility: hidden; /* Sembunyikan semua elemen */
            }
            #printableArea, #printableArea * {
                visibility: visible; /* Tampilkan hanya area yang ingin dicetak */
            }
            #printableArea {
                position: absolute; /* Mengatur posisi agar area cetak tidak terpengaruh */
                left: 0;
                top: 0;
            }
            table {
                width: 100%; /* Atur lebar tabel menjadi 100% saat dicetak */
                table-layout: fixed; /* Pastikan lebar kolom tetap */
            }
        }
    </style>

    <div class="p-4 sm:ml-64">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md inline-block mr-2 mb-6">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z"/>
                <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z"/>
            </svg>
        </button>
        <div id="printableArea">
            <div class="p-4 sm:p-7 overflow-y-auto">
                <div class="text-center mb-6">
                    <h1 class="font-bold text-3xl text-center">Detail Transaksi</h1>
                    <p class="text-md">No. Invoice: {{ $penjualan[0]->penjualanRelasi->id_transaksi}}</p>
                    <p class="text-md">Tanggal: {{ Carbon\Carbon::parse($penjualan[0]->created_at)->format('d-m-Y') }}</p>
                    <p class="text-md">Pelanggan: {{ $penjualan[0]->pelangganRelasi ? $penjualan[0]->pelangganRelasi->nama : 'Umum' }}</p>
                </div>
                <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
                    <!-- Menampilkan Detail Penjualan -->
                    <table class="min-w-full border-collapse border border-gray-200">
                        <thead>
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">Nama Barang</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Jumlah</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Harga Satuan</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan as $index => $p)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2"> {{ $p->barangRelasi ? $p->barangRelasi->nama_barang : 'N/A' }}</td>
                                    <td class="border border-gray-300 px-4 py-2"> (x{{ $p->jml_barang }} )</td>
                                    <td class="border border-gray-300 px-4 py-2">Rp. {{ $p->harga_satuan }}</td>
                                    <td class="border border-gray-300 px-4 py-2">Rp. {{ $p->hitungSubtotal() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Menampilkan Detail Penjualan -->

                    <!-- Menampilkan Total -->
                    <div class="py-3 bg-gray-50">
                        @php
                            $total = $penjualan->sum(fn($p) => $p->hitungSubtotal());
                            $diskon = $isMember ? $total * 0.1 : 0; // Cek apakah anggota
                            $totalAkhir = $total - $diskon; // Hitung total akhir setelah diskon
                        @endphp
                        <span class="block text-md font-semibold text-gray-800 text-right mb-5 mr-12">
                            Total: Rp. {{ $total }}
                        </span>
                        @if($isMember)
                            <span class="block text-md font-semibold text-gray-800 text-right mb-5 mr-12">
                                Diskon Member (10%): Rp. {{ $diskon }}
                            </span>
                        @endif
                        <span class="block text-md font-semibold text-gray-800 text-right mr-12">
                            Total Akhir: Rp. {{ $totalAkhir }}
                        </span>
                    </div>
                    <!-- End Menampilkan Total -->
                </div>
            </div>
        </div>
  <!-- End Table Section -->
        <a href="{{ url('/admin/laporan') }}" class="py-2 px-3 gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none text-center" style="z-index: 2; position: relative;">Kembali</a>
    </div>


@endsection
