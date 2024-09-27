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
        Schema::create('tb_comissaos', function (Blueprint $table) {
            $table->id();
            $table->string('afiliado');
            $table->foreign('afiliado')->references('cpf')->on('tb_afiliados');
            $table->decimal('valor');
            $table->timestamp('data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_comissaos');
    }
};
