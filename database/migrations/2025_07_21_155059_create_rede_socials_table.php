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
        Schema::create('redes_sociais', function (Blueprint $table) {
        $table->id('red_soc_id');
        $table->unsignedBigInteger('red_soc_dep_id');
        $table->string('red_soc_url');
        $table->timestamps();

        $table->foreign('red_soc_dep_id')->references('dep_id')->on('deputados')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redes_sociais');
    }
};
