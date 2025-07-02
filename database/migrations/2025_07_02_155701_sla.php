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
        Schema::create('sla', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment
            $table->string('nama_sla');
            $table->string('description');
            $table->string('time');
            $table->timestamps(); // created_at & updated_at, nullable by default
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
