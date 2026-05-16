<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('offre_stage_id')
                ->constrained('offre_stages')
                ->cascadeOnDelete();

            $table->text('contenu');

            $table->dateTime('dateCreation')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};