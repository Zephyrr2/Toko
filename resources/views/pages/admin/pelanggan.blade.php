@extends('layouts.master')

@section('content')
@include('partials.sidebar')

    <div class="p-4 sm:ml-64">
        <H1 class="text-center font-bold text-gray-900 text-xl mb-10">Data Pelanggan</H1>
        <a href="{{ url('/admin/pelanggan/add') }}" class="bg-blue-500 p-3 rounded-md text-white font-semibold mb-7">Tambah Pelanggan</a>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 mt-10">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Gender
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $plgn)
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                {{ $plgn->nama }}
                            </th>
                            <td class="px-6 py-4 text-gray-900 text-center">
                                {{ $plgn->gender }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 text-center">
                                <form action="{{ url('/admin/pelanggan/delete') }}" method="POST" class="inline">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id_pelanggan" value="{{ $plgn->id_pelanggan }}">
                                    <button class="inline-block p-3 text-white bg-red-600 hover:bg-red-700 focus:relative rounded-md" title="Delete User">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
