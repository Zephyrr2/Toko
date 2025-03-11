@extends('layouts.master')

@section('content')
    @include('partials.sidebar')

    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">

        <form
            action="{{ url('/admin/pegawai/edit/process') }}"
            method="POST"
            class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8"
        >
            @csrf
            <p class="text-center text-lg font-medium">Edit Employee</p>

            <div>
            <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>

            <div class="relative">
                <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_user }}">
                <input
                type="text"
                name="username"
                value="{{ $pegawai->username }}"
                class="w-full rounded-lg border-black border-2 p-4 pe-12 text-sm"
                />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-4 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 14c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.31 0-10 1.67-10 5v1h20v-1c0-3.33-6.69-5-10-5z"
                    />
                </svg>
                </span>
            </div>
            </div>

            <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>

            <div class="relative">
                <input
                type="email"
                name="email"
                value="{{ $pegawai->email }}"
                class="w-full rounded-lg border-black border-2 p-4 pe-12 text-sm"
                />

                <span class="absolute inset-y-0 end-0 grid place-content-center px-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-4 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"
                    />
                </svg>
                </span>
            </div>
            </div>

            <div>
                <label for="role" class="block text-sm/6 font-medium text-gray-900">Role</label>
                <div class="mt-2">
                    <select name="role" id="role" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option value="Admin" {{ $pegawai->role === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Pegawai" {{ $pegawai->role === 'Pegawai' ? 'selected' : '' }}>Pegawai</option>
                    </select>
                </div>
            </div>

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
