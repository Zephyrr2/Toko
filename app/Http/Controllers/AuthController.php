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
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        $HashedPass = Hash::make($password);

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = $HashedPass;
        $user->role = 'Pegawai';
        $user->save();

        return redirect('/admin/pegawai');
    }

    public function registerPegawai() {
        return view('pages.auth.register');
    }

    function loginProcess(Request $request) {
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        $user = User::where('email', $email)->first();

         if(!$user){
            return redirect('/')->with('error','email tidak terdaftar');
         }

         if (Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
            return redirect('/admin/pelanggan');
         }
    }

    public function login() {
        return view('pages.auth.login');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
