<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function registerProcess(Request $request) {
        $username = htmlspecialchars($request->input('username'));
        $password = htmlspecialchars($request->input('password'));

        $HashedPass = Hash::make($password);

        $user = new User();
        $user->username = $username;
        $user->password = $HashedPass;
        $user->role = 'Pegawai';
        $user->save();

        return redirect('/admin/pegawai');
    }

    public function registerPegawai() {
        return view('pages.auth.register');
    }

    function loginProcess(Request $request) {
        $username = htmlspecialchars($request->input('username'));
        $password = htmlspecialchars($request->input('password'));

        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            if ($user->role == 'Admin') {
                return redirect('/admin');
            } elseif ($user->role == 'Pegawai') {
                return redirect('/pegawai');
            }
        }

        return redirect('/login')->with('error', 'Username atau password salah');
    }

    public function login() {
        return view('pages.auth.login');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
