<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('secteur')->nullable();
            $table->string('adresse')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entreprises');
    }
};