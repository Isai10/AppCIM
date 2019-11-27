<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('examene_id')->nullable();
            $table->foreign('examene_id')->references('id')->on('examenes')->onDelete('cascade');
          //  $table->unsignedInteger('concurso_id')->nullable();
          //$table->foreign('concurso_id')->references('id')->on('concursos')->onDelete('cascade');
            $table->string('tipoPregunta');
            $table->float('valor',4,2);
            $table->string('pregunta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}
