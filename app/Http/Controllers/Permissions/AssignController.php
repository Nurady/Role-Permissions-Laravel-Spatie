<?php

namespace App\Http\Controllers\Permissions;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class AssignController extends Controller
{
    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('permission.assign.create', compact('roles', 'permissions'));
    }

    public function store()
    {
        request()->validate([
            'role' => 'required',
            'permissions' => 'array|required'
        ]);
        
        $role = Role::find(request('role'));
        $role->givePermissionTo(request('permissions'));

        return back()->with('success', "permissions has been added to rhe role {$role->name}");
    }

    public function edit(Role $role)
    {
        $roles = Role::get();
        $permissions = Permission::get();
        return view('permission.assign.edit', compact('role', 'roles', 'permissions'));
    }

    public function update(Role $role) 
    {
        request()->validate([
            'role' => 'required',
            'permissions' => 'array|required'
        ]);

        $role->syncPermissions(request('permissions'));
        
        return redirect()->route('assign.create')->with('success', "permissions has been sync to rhe role");
    }
}
