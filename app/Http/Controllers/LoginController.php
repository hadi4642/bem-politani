<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function view()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $nama = auth()->user()->nama;
            Alert::toast('Selamat datang '. $nama, 'success');
            return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->with('loginError', 'Email atau Password salah');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
