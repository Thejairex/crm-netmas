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
        $ranks = [
            ['name' => 'Guest', 'description' => 'Invitado', 'points_required' => 0],
            ['name' => 'Novice', 'description' => 'Principiante', 'points_required' => 0],
            ['name' => 'Beginner', 'description' => 'Inicio del camino', 'points_required' => 1000],
            ['name' => 'Intermediate', 'description' => 'Nivel intermedio', 'points_required' => 2500],
            ['name' => 'Expert', 'description' => 'Maestro del camino', 'points_required' => 4000],
        ];

        $prevRank = null;

        foreach ($ranks as $rank) {
            $newRank = Ranks::create($rank);
            if ($prevRank) {
                $prevRank->next_rank_id = $newRank->id;
                $prevRank->save();
            }
            $prevRank = $newRank;
        }
    }
}
