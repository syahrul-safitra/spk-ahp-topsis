<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        return view('Template.User.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        return view('Template.User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect('user')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        return view('Template.User.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6', // Gunakan nullable
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Hanya update password jika field diisi
        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect('user')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (! auth()->user()->is_admin) {
            return redirect('/');
        }

        $user->delete();

        return back()->with('success', 'Berhasil mengupdate data user');
    }
}
