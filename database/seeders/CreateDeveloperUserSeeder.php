<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateDeveloperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev = User::create([
            'first_name' => 'Vyan',
            'last_name' => 'Ary Pratama',
            'username' => 'vyandev',
            'email' => 'vyanaryprabowo9763@gmail.com',
            'password' => Hash::make("vyanary11")
        ]);

        $role = Role::create(['name' => 'Developer']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $dev->assignRole([$role->id]);

        $admin = User::create([
            'first_name' => 'Vyan',
            'last_name' => 'admin',
            'username' => 'vyanadmin',
            'email' => 'vyanadmin@gmail.com',
            'password' => Hash::make("vyanary11")
        ]);
        $role = Role::create(['name' => 'Admin']);
        $admin->assignRole([$role->id]);
    }
}
