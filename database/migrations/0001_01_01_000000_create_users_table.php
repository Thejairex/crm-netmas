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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // basic information
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('role')->default('customer'); // Roles: admin, customer, supplier
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->decimal('balance_points', 10, 2)->default(0);

            // additional information with KYC
            $table->enum('kyc_status', ['pending', 'verified', 'rejected', 'no_verified'])->default('no_verified');
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('phone')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_number')->nullable();
            $table->date('birth_date')->nullable();

            // Relationships
            $table->unsignedBigInteger('rank_id')->default(1);
            $table->unsignedBigInteger('next_rank_id')->default(2)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable(); // User who referred this user
            $table->rememberToken();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('set null');
            $table->foreign('next_rank_id')->references('id')->on('ranks')->onDelete('set null');
        });



        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
