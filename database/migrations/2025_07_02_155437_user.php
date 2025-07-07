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
            $table->id(); // bigint unsigned auto-increment
            $table->string('name');
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->string('status')->default('aktif');
            $table->string('alamat')->nullable();
            $table->string('no_hp')->default('-');
            $table->string('telegram_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken(); // otomatis varchar(100) nullable
            $table->timestamps(); // created_at & updated_at nullable
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
