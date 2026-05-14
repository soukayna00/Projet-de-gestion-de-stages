<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('signalements', function (Blueprint $table) {
            $table->id();

            // User who reports
            $table->foreignId('reporter_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Optional: reported user
            $table->foreignId('reported_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Optional: reported comment
            $table->foreignId('commentaire_id')
                ->nullable()
                ->constrained('commentaires')
                ->nullOnDelete();

            // Optional: reported offer
            $table->foreignId('offre_stage_id')
                ->nullable()
                ->constrained('offre_stages')
                ->nullOnDelete();

            $table->string('raison');

            $table->text('description')->nullable();

            $table->enum('statut', [
                'en_attente',
                'traite',
                'rejete'
            ])->default('en_attente');

            $table->dateTime('date_signalement')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signalements');
    }
};