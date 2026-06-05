<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('satgas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('unit'); // sar, konservasi, prestasi, regulasi
            $table->string('badge', 100)->nullable();
            $table->string('avatar_initials', 5);
            $table->integer('joined_year');
            $table->json('certifications')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('satgas');
    }
};