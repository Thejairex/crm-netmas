<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('min_points'); // minimo personal
            $table->unsignedInteger('max_points'); // maximo personal
            //$table->unsignedInteger('min_team_points'); // minimo equipo
            //$table->unsignedInteger('max_team_points'); // maximo equipo

            // Agregar un sistema de ranking requerido por el equipo para lograr el objetivo

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranks');
    }
};
