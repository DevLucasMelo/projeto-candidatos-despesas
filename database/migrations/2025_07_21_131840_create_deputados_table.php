<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('deputados', function (Blueprint $table) {
            $table->unsignedBigInteger('dep_id')->primary();
            $table->string('dep_nome');
            $table->string('dep_uri')->nullable();
            $table->string('dep_url_foto')->nullable();

            $table->unsignedBigInteger('dep_uf_id')->nullable();
            $table->unsignedBigInteger('dep_par_id')->nullable();

            $table->foreign('dep_uf_id')->references('uf_id')->on('ufs')->onDelete('set null');
            $table->foreign('dep_par_id')->references('par_id')->on('partidos')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deputados');
    }
};
