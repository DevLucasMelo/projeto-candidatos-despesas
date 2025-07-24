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
        Schema::create('deputados_profissoes', function (Blueprint $table) {
        $table->id('dep_pro_id');
        $table->unsignedBigInteger('dep_pro_dep_id');
        $table->unsignedBigInteger('dep_pro_pro_id');
        $table->timestamps();

        $table->foreign('dep_pro_dep_id')->references('dep_id')->on('deputados')->onDelete('cascade');
        $table->foreign('dep_pro_pro_id')->references('pro_id')->on('profissoes')->onDelete('cascade');
    });

    }
    public function down(): void
    {
        Schema::dropIfExists('deputado_profissao');
    }
};
