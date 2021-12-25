<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('permission.permissions.index', compact('permissions'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
        ]);
        
        Permission::create([
            'name' => request('name'),
            'guard_name' => 'web',
        ]);

        return back();
    }

    public function edit(Permission $permission)
    {
        return view('permission.permissions.edit', compact('permission'));
    }

    public function update(Permission $permission)
    {
        request()->validate([
            'name' => 'required',
        ]);
        
        $permission->update([
            'name' => request('name'),
        ]);

        return redirect()->route('permissions.index');
    }
}
