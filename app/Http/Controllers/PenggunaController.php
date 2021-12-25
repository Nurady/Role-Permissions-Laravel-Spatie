<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['permission:users.index|users.create|users.edit|users.delete']);
    // }

    public function index()
    {
        $users = User::latest()->when(request()->q, function($users) {
            $users = $users->where('name', 'like', '%'. request()->q . '%');
        })->get();
        
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::latest()->get();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed'
        ]);

        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password'))
        ]);

        //assign role
        $user->assignRole($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('pengguna.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('pengguna.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id
        ]);

        $user = User::findOrFail($user->id);

        if($request->input('password') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email')
            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]);
        }

        //assign role
        $user->syncRoles($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('pengguna.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('pengguna.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();


        if($user){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
