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
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'parent']);

        $admin = User::create([
            'name' => 'admin',
            'email'=> 'admin@easystep.com',
            'password'=> bcrypt('admin123'),
        ]); $admin->assignRole('admin');

        $parent = User::create([
            'name' => 'parent',
            'email'=> 'parent@easystep.com',
            'password'=> bcrypt('parent123')
        ]); $parent->assignRole('parent');
    }
}
