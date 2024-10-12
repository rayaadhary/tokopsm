<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();

        $title = 'Hapus pengguna!';
        $text = "Yakin menghapus pengguna ini?";
        confirmDelete($title, $text);

        return view('admin.user.index', compact('user'));
    }


    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.user')->with('message', 'pengguna telah ditambah');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $request->validated();

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.user')->with('message', 'data pengguna telah diubah');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user')->with('message', 'data pengguna telah dihapus');
    }
}
