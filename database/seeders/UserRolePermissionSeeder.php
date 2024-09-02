<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'addproduct']);
        Permission::firstOrCreate(['name' => 'browseproduct']);

        $userRole = Role::firstOrCreate(['name' => 'user']);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $adminRole->givePermissionTo('addproduct');
        $adminRole->givePermissionTo('browseproduct');
        $userRole->givePermissionTo('browseproduct');
        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin',
            'password' => Hash::make('12345678'),
        ]);

        $adminUser->assignRole($adminRole);
    }
}
