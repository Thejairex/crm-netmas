<?php

namespace Database\Seeders;

use App\Models\Ranks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ranks::create(['name' => 'Beginner', 'description' => 'Inicio del camino', 'min_points' => 0, 'max_points' => 100]);
        Ranks::create(['name' => 'Intermediate', 'description' => 'Nivel intermedio', 'min_points' => 101, 'max_points' => 500]);
        Ranks::create(['name' => 'Expert', 'description' => 'Maestro del camino', 'min_points' => 501, 'max_points' => 1000]);
    }
}
