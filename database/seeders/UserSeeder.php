<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xoá user admin nếu đã tồn tại
        User::where('email', 'admin@gmail.com')->delete();

        // Xoá role Super Admin nếu đã tồn tại
        Role::where('name', 'Super Admin')->delete();

        // Tạo lại Super Admin role
        $superAdminRole = Role::create(['name' => 'Super Admin']);

        // Tạo lại admin user
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123'),
        ]);

        // Gán quyền Super Admin cho user
        $admin->assignRole($superAdminRole);
    }
}
