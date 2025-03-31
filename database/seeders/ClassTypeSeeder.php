<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassType::create([
            'name' => 'Yoga',
            'description' => 'A relaxing yoga class.',
            'minuts' => 60,
        ]);
        ClassType::create([
            'name' => 'Dance Fitness',
            'description' => fake()->text(),
            'minuts' => 45,
        ]);
        ClassType::create([
            'name' => 'Pilates',
            'description' => fake()->text(),
            'minuts' => 60,
        ]);
        ClassType::create([
            'name' => 'Boxing',
            'description' => fake()->text(),
            'minuts' => 50,
        ]);
    }
}
