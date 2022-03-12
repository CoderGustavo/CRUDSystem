<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('tb_pessoa', function (Blueprint $table) {
            $table->id("idPessoa");
            $table->foreignId('idUsuario')->references('idUsuario')->on('tb_usuario');
            $table->string("Nome", 100);
            $table->integer("Idade")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
};
