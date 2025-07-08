<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Give all permissions to Admin role
        $adminRole->syncPermissions(Permission::all());

        // Get your admin user (email can be anything existing in your DB)
        $adminUser = User::where('email', 'admin@gmail.com')->first();

        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }
    }
}
