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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            // titolo
            $table->string('title', 64);
            // slug (testo dell'url)
            $table->string('slug')->unique();
            // descrizione
            $table->text('description', 4096);
            // immagine
            $table->string('cover', 2048)->nullable();
            // nome cliente
            $table->string('client', 64)->nullable();
            // settore lavorativo
            $table->string('sector', 64)->nullable();
            // progetto pubblicato
            $table->boolean('published')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
