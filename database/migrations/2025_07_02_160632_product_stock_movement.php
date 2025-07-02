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
        Schema::create('product_stock_movements', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment
            $table->string('custom_id');
            $table->date('transaction_date');

            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_supplier_id')->nullable()->constrained()->onDelete('set null');

            $table->enum('movement_type', ['masuk', 'keluar']);
            $table->integer('quantity');
            $table->enum('damage_status', ['none', 'damaged'])->default('none');
            $table->text('damage_reason')->nullable();

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
