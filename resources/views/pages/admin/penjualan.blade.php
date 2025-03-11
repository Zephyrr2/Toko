@extends('layouts.master')

@section('content')
    @include('partials.sidebar')

    <div class="p-4 sm:ml-64">
        <h1 class="font-bold text-4xl text-center mb-10">Invoice</h1>
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidde">

                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                        {{--
                        <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 ml-10">
                                Foto Barang
                            </span>
                            </div>
                        </th> --}}

                        <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 ml-10">
                                Kode Transaksi
                            </span>
                            </div>
                        </th>

                        <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 ml-10">
                                Tanggal
                            </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                Pelanggan
                            </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-start">
                            <div class="flex items-center gap-x-2">
                            <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">
                                Total Bayar
                            </span>
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-3 text-end"></th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @foreach ($penjualan->reverse() as $p)
                            <tr>
                                {{-- <td class="size-px whitespace-nowrap">
                                    <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                        <div class="flex items-center gap-x-3">
                                            <img src="{{ asset('img/' . $brg->foto) }}" alt="" class="w-24 h-32 mx-auto">
                                        </div>
                                    </div>
                                </td> --}}
                                <td class="size-px whitespace-nowrap">
                                    <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                        <div class="flex items-center gap-x-3">
                                            <span class="block text-sm font-semibold text-gray-800 ml-10">{{ $p->id_transaksi }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="size-px whitespace-nowrap">
                                    <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                                        <div class="flex items-center gap-x-3">
                                            <span class="block text-sm font-semibold text-gray-800 ml-10">{{ Carbon\Carbon::parse($p->created_at)->format('d-m-Y') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800">{{ $p->pelangganRelasi ? $p->pelangganRelasi->nama : 'Umum' }}</span>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span class="block text-sm font-semibold text-gray-800">{{ $p->total_transaksi }}</span>
                                    </div>
                                </td>
                                <td class="size-px whitespace-nowrap">
                                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="{{ url('/admin/invoice/detail/' . $p->id_transaksi) }}">
                                        Lihat
                                    </a>
                                            {{-- <form action="{{ url('/admin/barang/delete') }}" method="POST" class="inline">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="id_barang" value="{{ $brg->id_barang }}">
                                                <button class="inline-block p-3 text-white bg-red-600 hover:bg-red-700 focus:relative" title="Delete Barang">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </span>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <!-- End Table -->
                </div>
                </div>
            </div>
            </div>
            <!-- End Card -->
        </div>
  <!-- End Table Section -->
    </div>
@endsection
