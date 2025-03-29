<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Member',
            'email' => 'member@gmail.com',
            'password' => Hash::make('123456'),
            'role'=>'member'
        ]);
        User::factory()->create([
            'name' => 'Instructor',
            'email' => 'instructor@gmail.com',
            'password' => Hash::make('123456'),
            'role'=>'instructor'
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role'=>'admin'
        ]);

        User::factory()->count(10)->create();
        User::factory()->count(10)->create([
            'role' => 'instructor'
        ]);
    }
}
