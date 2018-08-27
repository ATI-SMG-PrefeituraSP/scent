<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecificacaoTecnicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especificacao_tecnicas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nome_produto')->nullable();
            $table->date('data_criacao')->nullable();
            $table->string('diretorio_word')->nullable();
            $table->string('arquivo_word')->nullable();
            $table->string('codigo_suprimentos')->nullable();
            $table->string('unidade')->nullable();
            $table->integer('itens')->nullable();
            $table->string('codigo_catmat')->nullable();
            $table->date('data_revisao')->nullable();
            $table->string('arquivo')->nullable();
            $table->string('arquivo_caminho')->nullable();
            $table->string('combinacao')->nullable();

            //chaves estrangeiras
            $table->integer('tipo_especificacao_id', false, true)->nullable();
            $table->foreign('tipo_especificacao_id')->references('id')->on('tipo_especificacaos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especificacao_tecnicas');
    }
}
