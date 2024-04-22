<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Perpus | Users';

    // menampilkan halaman utama
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::latest()->get(),
            'title' => $this->title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // menampilkan halaman tambah data
    public function create()
    {
        return view('dashboard.users.create', [
            'title' => $this->title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // menambahkan data ke db
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:member,librarian,admin',
            'password' => 'required|string|min:8'
        ]);

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // If user creation is successful, redirect to /dashboard/users
        return redirect('/dashboard/users')->with('success', 'User created successfully!');
        // if ($user) {
        // } else {
        //     // If creation fails, redirect back with an error message
        //     return redirect()->back()->withInput()->with('error', 'Failed to create user.');
        // }
    }


    /**
     * Display the specified resource.
     */
    // menampilkan detail perdata
    public function show(User $user)
    {
        return view('dashboard.users.show', [
            'user' => $user,
            'title' => $this->title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // menampilkan form edit data
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'title' => $this->title,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    // mengupdate data ke db
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role' => ['required']
        ]);
        $user = User::where('id', $user->id)->update($validatedData);
        return redirect('/dashboard/users/')->with('successEdit', "Role successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    // menghapus data
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('successDelete', "$user->username has been deleted!");
    }
    public function exportPDF()
    {
        $user = User::all();
        $data['users'] = $user;
        $pdf = Pdf::loadView('pdf.user', $data);
        return $pdf->download(Carbon::now() . '_users_report.pdf');
    }
}
