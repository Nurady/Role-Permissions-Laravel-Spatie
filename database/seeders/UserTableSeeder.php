<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create data user
        User::create([
            'name'      => 'Nur Izzan Al-Faizi',
            'email'     => 'izzan@gmail.com',
            'password'  => bcrypt('12345678')
        ]);

        User::create([
            'name'      => 'Nurmya Hamidah',
            'email'     => 'mya@gmail.com',
            'password'  => bcrypt('12345678')
        ]);

        //assign permission to role
        $role = Role::find(1);
        $role2 = Role::find(2);
        // $permissions = Permission::all();

        // $role->syncPermissions($permissions);

        //assign role with permission to user
        $user = User::find(1);
        $user2 = User::find(2);
        $user->assignRole($role->name);
        $user2->assignRole($role2->name);
    }
}
