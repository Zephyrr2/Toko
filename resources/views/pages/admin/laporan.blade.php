@extends('layouts.master')
@section('content')
    <style>
        @media print {
            body * {
                visibility: hidden; /* Hide all elements */
            }
            #printableArea, #printableArea * {
                visibility: visible; /* Show only the area to be printed */
            }
            #printableArea {
                position: absolute; /* Set position so print area is not affected */
                left: 0;
                top: 0;
            }
            table {
                width: 100%; /* Set table width to 100% when printed */
                table-layout: fixed; /* Ensure column width remains */
            }
        }
    </style>
    @include('partials.sidebar')
    <div class="p-4 sm:ml-64">
        <div class="flex justify-between mb-6 items-center">

            <!-- Print Button -->
            <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md inline-block">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z"/>
                    <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z"/>
                </svg>
            </button>
        </div>

        <div class="p-4 border border-gray-200 rounded-lg">
            <div id="printableArea">
                <h2 class="text-2xl font-semibold mb-10 text-center">Sales Report</h2>

                <!-- Add filter form -->
                <div class="mb-6 flex gap-4 items-end print:hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="mt-1 p-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="mt-1 p-2 border rounded-md">
                    </div>
                    <button id="filterBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Filter
                    </button>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Invoice No</th>
                                <th scope="col" class="px-6 py-3">Customer</th>
                                <th scope="col" class="px-6 py-3">Total</th>
                                <th scope="col" class="px-6 py-3 print:hidden"></th>
                            </tr>
                        </thead>
                        <tbody id="reportTable">
                            @foreach($penjualan as $index => $item)
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                <td class="px-6 py-4">{{ $item->id_transaksi }}</td>
                                <td class="px-6 py-4">{{ $item->pelangganRelasi->nama ?? 'Umum' }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($item->total_transaksi, 0, ',', '.') }}</td>
                                <td class="print:hidden"><a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ url('/admin/invoice/detail/' . $item->id_transaksi) }}">
                                    View
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('filterBtn').addEventListener('click', function() {
                const startDate = document.getElementById('start_date').value;
                const endDate = document.getElementById('end_date').value;

                fetch(`/admin/filter-laporan?start_date=${startDate}&end_date=${endDate}`)
                    .then(response => response.json())
                    .then(data => {
                        const tableBody = document.getElementById('reportTable');
                        tableBody.innerHTML = '';

                        data.forEach((item, index) => {
                            const tanggal = new Date(item.created_at).toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            });
                            const row = `
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">${index + 1}</td>
                                    <td class="px-6 py-4">${tanggal}</td>
                                    <td class="px-6 py-4">${item.id_transaksi}</td>
                                    <td class="px-6 py-4">${item.pelanggan_relasi ? item.pelanggan_relasi.nama : 'General'}</td>
                                    <td class="px-6 py-4">Rp ${new Intl.NumberFormat('id-ID').format(item.total_transaksi)}</td>
                                </tr>
                            `;
                            tableBody.innerHTML += row;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
    </div>
@endsection
