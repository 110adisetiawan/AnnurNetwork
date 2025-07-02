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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment
            $table->string('name');
            $table->string('sku');
            $table->foreignId('product_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_supplier_id')->constrained()->onDelete('cascade');
            $table->integer('stock')->default(0);
            $table->string('price')->default('');
            $table->enum('condition', ['normal', 'damaged'])->default('normal');
            $table->text('damage_description')->nullable();
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
