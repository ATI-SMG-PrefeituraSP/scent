<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNormaTecnicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('norma_tecnicas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('nome')->nullable();
            $table->string('data')->nullable();
            $table->string('norma')->nullable();
            $table->string('nbr')->nullable();
            $table->string('palachave')->nullable();
            $table->string('paginas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('norma_tecnicas');
    }
}
