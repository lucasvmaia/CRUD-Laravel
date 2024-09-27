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
        Schema::defaultStringLength(191);
        Schema::create('tb_usuarios', function (Blueprint $table) {
            $table->id();
            $table->integer('id_perfil')->unsigned();
            $table->foreign('id_perfil')->references('id_perfil')->on('tb_perfils');
            $table->string('email')->unique();
            $table->string('nome');
            $table->string('senha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_usuarios');
    }
};
