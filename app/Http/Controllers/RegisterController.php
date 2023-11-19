<?php

namespace App\Http\Controllers;

// use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public $title = 'Daftar | LP';
    public function index()
    {
        return view('register', [
            'title' => $this->title
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'username' => ['required', 'unique:users', 'max:20', 'min:4'],
            'name' => ['required', 'max:100'],
            'password' => ['required', 'min:8'],
            'role' => ['required'],
            'prof_pic' => ['required']
        ]);
        // password hash
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        // succes
        return redirect('/')->with('success', '<strong>Successfully create accountt!</strong> <br>Please Sign In');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('successLogout', 'Your session has been ended!');
    }

}
