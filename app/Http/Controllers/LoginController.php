<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public $title = 'Masuk | Perpus';
    // menampilkan form login
    public function index()
    {
        return view('login', [
            'title' => $this->title
        ]);
    }
    // fungsi login mencocokan data yng dimasukan dengan yg ada di db
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        // kalau berhasil masuk
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        // kalo gagal kembali lagi dengan pesan error
        return back()->with('loginFail', 'wrong username or password');
    }
}
