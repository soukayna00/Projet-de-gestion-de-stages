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
        Schema::create('offre_stages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('entreprise_id')
                ->constrained('entreprises')
                ->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('domaine')->nullable();
            $table->string('type')->nullable();

            $table->date('datePublication')->nullable();
            $table->date('dateDebut')->nullable();
            $table->date('dateFin')->nullable();

            $table->foreignId('id_ville')
            ->nullable()
            ->constrained('villes')
            ->nullOnDelete();

            $table->string('statut')->default('en_attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_stages');
    }
};
