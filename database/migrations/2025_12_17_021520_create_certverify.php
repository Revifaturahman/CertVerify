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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_id')->unique();
            $table->string('nim');
            $table->string('name');
            $table->string('event_name');
            $table->string('template_name');
            $table->date('issued_at');
            $table->enum('status', ['ISSUED', 'REVOKED'])->default('ISSUED');
            $table->string('hash_value')->nullable(); // hanya referensi
            $table->timestamps();
            $table->index('certificate_id');
            $table->index('nim');
        });

        Schema::create('blockchain_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certificate_id')
                ->constrained('certificates')
                ->cascadeOnDelete();

            $table->string('tx_hash');
            $table->unsignedBigInteger('block_number')->nullable();
            $table->string('network')->default('local');
            $table->timestamps();
        });

        Schema::create('verification_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('certificate_id')
                ->nullable()
                ->constrained('certificates')
                ->nullOnDelete();

            $table->string('input_certificate_id');
            $table->string('input_nim');

            $table->foreignId('verified_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('result', ['VALID', 'INVALID']);
            $table->timestamp('verified_at');
            $table->string('ip_address')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('blockchain_records');
        Schema::dropIfExists('verification_logs');
    }
};
