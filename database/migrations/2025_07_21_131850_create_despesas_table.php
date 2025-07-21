<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->bigIncrements('des_id');
            $table->unsignedBigInteger('des_dep_id'); 
            $table->bigInteger('des_cod_documento')->nullable();
            $table->string('des_tipo_despesa')->nullable();
            $table->string('des_fornecedor')->nullable();
            $table->integer('des_ano');
            $table->integer('des_mes');
            $table->decimal('des_valor_documento', 10, 2)->nullable();
            $table->decimal('des_valor_glosa', 10, 2)->nullable();
            $table->decimal('des_valor_liquido', 10, 2)->nullable();
            $table->date('des_data_documento')->nullable();
            $table->timestamps();

            $table->foreign('des_dep_id')
                ->references('dep_id')
                ->on('deputados')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('despesas');
    }
};
