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
        Schema::create('myuser', function (Blueprint $table) {
            $table->id(); // Kolom ID dengan tipe big integer auto increment
            $table->string('username', 500)->unique(); // Kolom username dengan maksimal 50 karakter dan unik
            $table->string('password'); // Kolom password_hash untuk menyimpan hash password
            $table->string('email', 100)->unique(); // Kolom email dengan maksimal 100 karakter dan unik
            $table->timestamps(); // Kolom created_at dan updated_at
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
