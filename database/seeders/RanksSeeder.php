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
        Ranks::create(['name' => 'Guest', 'description' => 'Invitado', 'points_required' => 0]);
        Ranks::create(['name' => 'Beginner', 'description' => 'Inicio del camino', 'points_required' => 1000]);
        Ranks::create(['name' => 'Intermediate', 'description' => 'Nivel intermedio', 'points_required' => 2500]);
        Ranks::create(['name' => 'Expert', 'description' => 'Maestro del camino', 'points_required' => 4000]);
    }
}
