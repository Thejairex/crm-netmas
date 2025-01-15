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
        Schema::create('kyc_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // Información personal
            $table->string('name');
            $table->string('lastname');
            $table->string('gender');
            $table->string('phone');
            $table->string('document_type');
            $table->string('document_number');
            $table->string('document_image'); // url image
            $table->date('birth_date');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable(); // Puede ser el id del administrador
            $table->text('rejection_reason')->nullable(); // Motivo de rechazo

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('verified_by')->references('id')->on('users')->onDelete('set null'); // Si es un administrador

            $table->timestamps();
        });
        Schema::create('linked_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('linked_account_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('linked_account_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linked_accounts');
        Schema::dropIfExists('kyc_entries');
    }
};
