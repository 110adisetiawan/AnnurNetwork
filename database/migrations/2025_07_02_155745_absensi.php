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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('masuk')->nullable();
            $table->dateTime('pulang')->nullable();
            $table->enum('keterangan', ['hadir', 'izin', 'sakit', 'alfa'])->default('alfa');
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
