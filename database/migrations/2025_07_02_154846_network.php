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
        Schema::create('networks', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment
            $table->string('nama_device');
            $table->string('serial_number');
            $table->string('ip_address');
            $table->string('status')->default('active');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps(); // created_at dan updated_at
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
