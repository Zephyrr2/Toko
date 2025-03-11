@extends('layouts.master')

@section('content')
    @include('partials.sidebar')

    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">

        <form
            action="{{ url('/admin/barang/edit/process') }}"
            method="POST"
            enctype="multipart/form-data"
            class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8"
        >
            @csrf
            <p class="text-center text-lg font-medium">Edit Item {{ $barang->nama_barang }}</p>

            <div>
                <label for="nama_barang" class="block text-sm/6 font-medium text-gray-900">Item Name</label>

                <div class="relative">
                    <input type="hidden" name="id_barang" value="{{ $barang->id_barang }}">
                    <input
                    type="text"
                    id="nama_barang"
                    name="nama"
                    class="w-full rounded-lg border-black border-2 p-4 pe-12 text-sm"
                    value="{{ $barang->nama_barang }}"
                    />

                </div>
            </div>
            <div>
                <label for="harga_barang" class="block text-sm/6 font-medium text-gray-900">Item Price</label>

                <div class="relative">
                    <input
                    type="number"
                    id="harga_barang"
                    name="harga"
                    class="w-full rounded-lg border-black border-2 p-4 pe-12 text-sm"
                    value="{{ $barang->harga_barang }}"
                    />
                </div>
            </div>
            <div>
                <label for="stok_barang" class="block text-sm/6 font-medium text-gray-900">Item Stock</label>

                <div class="relative">
                    <input
                    type="number"
                    id="stok_barang"
                    name="stok"
                    class="w-full rounded-lg border-black border-2 p-4 pe-12 text-sm"
                    value="{{ $barang->stock}}"
                    />
                </div>
            </div>
            {{-- <div>
                <label for="foto_barang" class="sr-only">Item Photo</label>

                <div class="relative">
                    <input
                    type="file"
                    id="foto_barang"
                    name="foto"
                    class="block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 file:cursor-pointer"
                    placeholder="Select photo"
                    />
                </div>
            </div> --}}

            <button
            type="submit"
            class="block w-full rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white"
            >
            Submit
            </button>
        </form>
        </div>
    </div>
@endsection
