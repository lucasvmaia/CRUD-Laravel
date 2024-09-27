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
        Schema::create('tb_afiliados', function (Blueprint $table) {
            $table->id();
            $table->integer('id_perfil')->unsigned();
            $table->foreign('id_perfil')->references('id_perfil')->on('tb_perfils');
            $table->string('email')->unique();
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->date('dataNascimento');
            $table->string('telefone');
            $table->string('endereco');
            $table->string('cidade');
            $table->string('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_afiliados');
    }
};
