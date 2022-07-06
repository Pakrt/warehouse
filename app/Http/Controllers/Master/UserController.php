<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Master\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::with('roles')->get();

        return view('master.user.index', compact('user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'bail|required|string|unique:users',
            'username' => 'bail|required|string|unique:users',
            'name' => 'required|string',
        ]);

        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'role_id' => $request->role_id,
            'username' => $request->username,
            'password' => Hash::make('warehouse123')
        ]);

        return Redirect::route('user.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Membuat data crew'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::get();

        return view('master.user.edit', compact('user', 'role'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'email' => $request->email,
            'name' => $request->name,
            'username' => $request->username,
            'role_id' => $request->role_id,
        ]);

        return Redirect::route('user.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Mengubah data crew'
        ]);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return Redirect::route('user.index')
        ->with([
            'status' => 'success',
            'tittle' => 'Success',
            'messages' => 'Menghapus data useer'
        ]);
    }

    public function changePassword()
    {
        return view('auth.forgot-password');
    }
}
