<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Perpus | My Profile';

    // menmpilkan halaman utama
    public function index()
    {
        // show profile
        return view('dashboard.profile.index', [
            'title' => $this->title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // menampilkan form edit data
    public function edit()
    {
        return view('dashboard.profile.edit', [
            'title' => $this->title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // mengupdate data ke db
    public function update(Request $request)
    {
        // update profile
        $data = $request->validate([
            'name' => ['required', 'max:100'],
            'email' => 'required|email|unique:users,email,' . $request->id,
            'username' => 'required|min:4|unique:users,username,' . $request->id,
            'prof_pic' => ['file', 'image']
        ]);
        if ($request->file('prof_pic')) {
            $data['prof_pic'] = $request->file('prof_pic')->store('profile');
        }

        $user = User::where('id', auth()->user()->id)->update($data);

        return redirect()->route('user-profile')->with('successEdit', 'Profile kamu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
