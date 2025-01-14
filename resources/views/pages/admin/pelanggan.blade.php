@extends('layouts.master')

@section('content')
@include('partials.sidebar')

    <div class="p-4 sm:ml-64">
        <H1 class="text-center font-bold text-gray-900 text-xl mb-10">Data Pelanggan</H1>
        <a href="{{ url('/admin/pelanggan/add') }}" class="bg-green-400 p-3 rounded-md text-white font-semibold mb-7">Add Pelanggan</a>

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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
