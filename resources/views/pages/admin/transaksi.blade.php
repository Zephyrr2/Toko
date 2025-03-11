@extends('layouts.master')

@section('content')

@include('partials.sidebar')

    <div class="p-4 sm:ml-64">

        <div class="container">
            <h2 class="text-center font-bold text-2xl mb-20">Sales Transactions</h2>

            <style>
                @media print {
                    /* Reset semua visibility */
                    body * {
                        visibility: hidden !important;
                        margin: 0 !important;
                        padding: 0 !important;
                    }

                    /* Tampilkan hanya area print */
                    #printArea, #printArea * {
                        visibility: visible !important;
                    }

                    /* Atur posisi area print */
                    #printArea {
                        position: absolute !important;
                        left: 0 !important;
                        top: 0 !important;
                        width: 100% !important;
                    }

                    /* Style tabel */
                    #printArea table {
                        width: 100% !important;
                        border-collapse: collapse !important;
                        margin-bottom: 1rem !important;
                    }

                    #printArea th,
                    #printArea td {
                        border: 1px solid black !important;
                        padding: 8px !important;
                        text-align: left !important;
                    }

                    /* Style header */
                    #printArea .text-center {
                        text-align: center !important;
                        margin-bottom: 2rem !important;
                    }

                    #printArea h1 {
                        font-size: 24px !important;
                        font-weight: bold !important;
                        margin-bottom: 1rem !important;
                    }

                    #printArea p {
                        margin-bottom: 0.5rem !important;
                    }
                }
            </style>

            <form action="{{ route('simpanTransaksi') }}" method="POST" id="transaksiForm">
                @csrf
                <div class="mb-3">
                    <label for="id_pelanggan">Member ID:</label>
                    <input type="text" name="id_pelanggan" id="id_pelanggan" class="w-32 h-7 rounded-lg border-black border-2 p-4 pe-12 text-sm">
                    <div id="status-member" class="mt-2"></div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-5" role="alert">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">{{ session('error') }}</div>
                @endif

                <div class="mt-4 text-right">
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none mb-5">Save Transaction</button>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 ml-10">
                                        Item ID
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 ml-10">
                                        Item Name
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                        Item Price
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                        Amount
                                    </span>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                        Subtotal
                                    </span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="barang-container">
                        <tr class="barang-item">
                            <td class="size-px whitespace-nowrap">
                                <div class="ps-6 lg:ps-3 xl:ps-0 pe-5 py-3">
                                    <input type="text" name="barang[0][id_barang]" class="w-full h-7 rounded-lg border-black border-2 p-4 pe-12 text-sm id-barang">
                                </div>
                            </td>
                            <td class="size-px whitespace-nowrap">
                                <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                    <input type="text" class="form-control nama-barang" readonly>
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <input type="text" class="form-control harga-satuan" readonly>
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <input type="number" name="barang[0][jml_barang]" class="w-full h-7 rounded-lg border-black border-2 p-4 pe-12 text-sm jumlah" min="0" value="0">
                                </div>
                            </td>
                            <td class="h-px w-72 whitespace-nowrap">
                                <div class="px-6 py-3">
                                    <input type="text" class="form-control subtotal" readonly>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-4 text-right">
                    <h4 class="mr-44 font-bold">Total: <span id="total">Rp 0</span></h4>
                </div>

                <button type="button" id="add-barang" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Tambah Barang</button>
            </form>
        </div>

        <!-- Modifikasi struktur area print -->
        <div id="printArea" style="display:none;">
            <div class="text-center">
                <h1>Transaction Details</h1>
                <p id="printInvoiceNo"></p>
                <p id="printTanggal"></p>
                <p id="printPelanggan"></p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 35%">Item Name</th>
                        <th style="width: 15%">Amount</th>
                        <th style="width: 20%">Item Price</th>
                        <th style="width: 25%">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="printItems">
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold;">Total:</td>
                        <td id="printTotal"></td>
                    </tr>
                    <tr id="printDiskonRow" style="display:none;">
                        <td colspan="4" style="text-align: right; font-weight: bold;">Member Discount (10%):</td>
                        <td id="printDiskon"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold;">Final Total:</td>
                        <td id="printTotalAkhir"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let barangIndex = 1;

                function hitungSubtotal(row) {
                    const harga = parseFloat(row.querySelector('.harga-satuan').value) || 0;
                    const jumlah = parseInt(row.querySelector('.jumlah').value) || 0;
                    const subtotal = harga * jumlah;
                    row.querySelector('.subtotal').value = 'Rp ' + subtotal.toLocaleString('id-ID');
                    hitungTotal();
                }

                function hitungTotal() {
                    let total = 0;
                    document.querySelectorAll('.barang-item').forEach(row => {
                        const harga = parseFloat(row.querySelector('.harga-satuan').value) || 0;
                        const jumlah = parseInt(row.querySelector('.jumlah').value) || 0;
                        total += harga * jumlah;
                    });
                    document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
                }

                function updateBarangListener() {
                    document.querySelectorAll('.id-barang').forEach(input => {
                        input.addEventListener('change', function() {
                            let idBarang = this.value;
                            let parent = this.closest('.barang-item');
                            fetch(`/barang/${idBarang}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data) {
                                        parent.querySelector('.nama-barang').value = data.nama_barang;
                                        parent.querySelector('.harga-satuan').value = data.harga_barang;
                                        parent.querySelector('.jumlah').value = '0';
                                        hitungSubtotal(parent);
                                    } else {
                                        parent.querySelector('.nama-barang').value = '';
                                        parent.querySelector('.harga-satuan').value = '';
                                        parent.querySelector('.jumlah').value = '0';
                                        hitungSubtotal(parent);
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        });
                    });

                    document.querySelectorAll('.jumlah').forEach(input => {
                        input.addEventListener('change', function() {
                            const jumlah = parseInt(this.value) || 0;
                            if (jumlah > 0) {
                                tambahBarisBaru();
                            }
                            hitungSubtotal(this.closest('.barang-item'));
                        });
                    });
                }

                function tambahBarisBaru() {
                    let container = document.getElementById('barang-container');
                    let newRow = document.createElement('tr');
                    newRow.classList.add('barang-item');
                    newRow.innerHTML = `
                        <td class="size-px whitespace-nowrap">
                            <div class="ps-6 lg:ps-3 xl:ps-0 pe-5 py-3">
                                <input type="text" name="barang[${barangIndex}][id_barang]" class="w-full h-7 rounded-lg border-black border-2 p-4 pe-12 text-sm id-barang">
                            </div>
                        </td>
                        <td class="size-px whitespace-nowrap">
                            <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                <input type="text" class="form-control nama-barang" readonly>
                            </div>
                        </td>
                        <td class="h-px w-72 whitespace-nowrap">
                            <div class="px-6 py-3">
                                <input type="text" class="form-control harga-satuan" readonly>
                            </div>
                        </td>
                        <td class="h-px w-72 whitespace-nowrap">
                            <div class="px-6 py-3">
                                <input type="number" name="barang[${barangIndex}][jml_barang]" class="w-full h-7 rounded-lg border-black border-2 p-4 pe-12 text-sm jumlah" min="0" value="0">
                            </div>
                        </td>
                        <td class="h-px w-72 whitespace-nowrap">
                            <div class="px-6 py-3">
                                <input type="text" class="form-control subtotal" readonly>
                            </div>
                        </td>
                    `;
                    container.appendChild(newRow);
                    updateBarangListener();
                    barangIndex++;
                }

                document.getElementById('add-barang').style.display = 'none'; // Sembunyikan tombol "Tambah Barang"

                updateBarangListener();

                // Cek status pelanggan saat ID dimasukkan
                document.getElementById('id_pelanggan').addEventListener('change', function() {
                    let idPelanggan = this.value;
                    fetch(`/cek-pelanggan/${idPelanggan}`)
                        .then(response => response.json())
                        .then(data => {
                            let statusDiv = document.getElementById('status-member');
                            if (data.status === 'member') {
                                statusDiv.innerHTML = '<span class="text-success">Pelanggan Terdaftar (Mendapat Diskon)</span>';
                            } else {
                                statusDiv.innerHTML = '<span class="text-danger">Pelanggan Tidak Terdaftar (Tanpa Diskon)</span>';
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });

                // Modifikasi fungsi printInvoice
                function printInvoice(data) {
                    // Tampilkan area print sebelum mencetak
                    const printArea = document.getElementById('printArea');
                    printArea.style.display = 'block';

                    // Isi data
                    document.getElementById('printInvoiceNo').textContent = 'No. Invoice: ' + data.id_transaksi;
                    document.getElementById('printTanggal').textContent = 'Tanggal: ' + new Date().toLocaleDateString('id-ID');
                    document.getElementById('printPelanggan').textContent = 'Pelanggan: ' + (data.nama_pelanggan || 'Umum');

                    let printItems = '';
                    data.items.forEach((item, index) => {
                        printItems += `
                            <tr>
                                <td style="text-align: center">${index + 1}</td>
                                <td>${item.nama_barang}</td>
                                <td style="text-align: center">${item.jumlah}</td>
                                <td style="text-align: right">Rp ${item.harga_satuan.toLocaleString('id-ID')}</td>
                                <td style="text-align: right">Rp ${(item.jumlah * item.harga_satuan).toLocaleString('id-ID')}</td>
                            </tr>
                        `;
                    });
                    document.getElementById('printItems').innerHTML = printItems;

                    // Isi total-total
                    document.getElementById('printTotal').textContent = 'Rp ' + data.total.toLocaleString('id-ID');

                    if (data.is_member) {
                        document.getElementById('printDiskonRow').style.display = 'table-row';
                        document.getElementById('printDiskon').textContent = 'Rp ' + data.diskon.toLocaleString('id-ID');
                    }

                    document.getElementById('printTotalAkhir').textContent = 'Rp ' + data.total_akhir.toLocaleString('id-ID');

                    // Tunggu sebentar untuk memastikan semua konten telah dirender
                    setTimeout(() => {
                        window.print();

                        // Sembunyikan kembali area print setelah selesai
                        printArea.style.display = 'none';

                        // Reset form
                        document.getElementById('transaksiForm').reset();
                        const barangItems = document.querySelectorAll('.barang-item');
                        for (let i = 1; i < barangItems.length; i++) {
                            barangItems[i].remove();
                        }
                        hitungTotal();
                    }, 500);
                }

                // Modifikasi event listener form submit
                document.getElementById('transaksiForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    fetch(this.action, {
                        method: 'POST',
                        body: new FormData(this),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            printInvoice(data);
                        } else {
                            alert('Terjadi kesalahan saat menyimpan transaksi');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menyimpan transaksi');
                    });
                });
            });
        </script>
    </div>
@endsection
