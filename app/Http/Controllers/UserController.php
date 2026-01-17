<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $karyawans = User::with('role')->where('role_id', '!=', 4)->get();
        return view('admin.User.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('id', '!=', 4)->get();
        return view('admin.User.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'phone' => $request->phone,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.User.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $roles = Role::where('id', '!=', 4)->get();
        $user = User::findOrFail($id);
        return view('admin.User.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|numeric',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
