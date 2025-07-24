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
        Schema::create('gabinetes', function (Blueprint $table) {
            $table->id('gab_id');
            $table->string('gab_nome')->nullable();
            $table->string('gab_predio')->nullable();
            $table->string('gab_sala')->nullable();
            $table->string('gab_andar')->nullable();
            $table->string('gab_telefone')->nullable();
            $table->string('gab_email')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gabinetes');
    }
};
