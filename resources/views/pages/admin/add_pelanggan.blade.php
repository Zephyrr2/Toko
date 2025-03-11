@extends('layouts.master')

@section('content')
    @include('partials.sidebar')

    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg">

        <form
            action="{{ url('/admin/pelanggan/add/process') }}"
            method="POST"
            class="mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8"
        >
            @csrf
            <p class="text-center text-lg font-medium">Add Member</p>

            <div>
            <label for="nama" class="block text-sm/6 font-medium text-gray-900">Member ID</label>

            <div class="relative">
                <input
                type="text"
                name="id_pelanggan"
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

            <label for="nama" class="block text-sm/6 font-medium text-gray-900">Name</label>

            <div class="relative">
                <input
                type="text"
                name="nama"
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
                <label for="gender" class="block text-sm/6 font-medium text-gray-900">Gender</label>
                <div class="mt-2">
                    <select name="gender" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    <option value="">Select Gender</option>
                    <option value="P">P</option>
                    <option value="L">L</option>
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
