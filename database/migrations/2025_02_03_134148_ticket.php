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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('priority_id')->constrained('priorities')->onDelete('cascade');
            $table->foreignId('sla_id')->constrained('sla')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('image_address');
            $table->string('latitude_ticket');
            $table->string('longitude_ticket');
            $table->string('image_task')->nullable();
            $table->string('latitude_task')->nullable();
            $table->string('longitude_task')->nullable();
            $table->string('status')->default('open');
            $table->string('closed_by')->nullable();
            $table->timestamps();
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
