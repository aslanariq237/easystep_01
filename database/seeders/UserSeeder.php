<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'parent']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@easystep.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('admin123'),
            ]
        );
        $admin->assignRole('admin');

        $parent = User::firstOrCreate(
            ['email' => 'parent@easystep.com'],
            [
                'name' => 'parent',
                'password' => bcrypt('parent123'),
            ]
        );
        $parent->assignRole('parent');
    }
}
