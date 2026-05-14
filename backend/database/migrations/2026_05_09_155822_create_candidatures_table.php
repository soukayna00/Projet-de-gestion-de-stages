<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();

            $table->foreignId('stagiaire_id')
                ->constrained('stagiaires')
                ->cascadeOnDelete();

            $table->foreignId('offre_stage_id')
                ->constrained('offre_stages')
                ->cascadeOnDelete();

            $table->dateTime('datePostulation')->useCurrent();

            $table->string('cv')->nullable();

            $table->text('lettreMotivation')->nullable();

            $table->enum('statut', [
                'en_attente',
                'acceptee',
                'refusee'
            ])->default('en_attente');

            $table->timestamps();

            $table->unique([
                'stagiaire_id',
                'offre_stage_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};