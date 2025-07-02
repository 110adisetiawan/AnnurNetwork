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
            $table->id(); // bigint unsigned auto-increment
            $table->string('custom_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('priority_id')->constrained()->onDelete('cascade');
            $table->foreignId('sla_id')->constrained('sla')->onDelete('cascade');
            $table->foreignId('task_id')->constrained()->onDelete('cascade');

            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('image_address')->nullable();

            $table->string('latitude_ticket');
            $table->string('longitude_ticket');
            $table->string('image_task')->nullable();
            $table->string('latitude_task')->nullable();
            $table->string('longitude_task')->nullable();

            $table->string('status')->default('open');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('note')->nullable();
            $table->string('closed_by')->nullable();

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
