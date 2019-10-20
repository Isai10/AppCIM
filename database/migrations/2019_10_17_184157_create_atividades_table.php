<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idCurso');
            $table->unsignedInteger('idTipoActivida');
            $table->string('idGenerico')->unique();
            $table->unsignedInteger('idTema');
            $table->unsignedInteger('idSubtema');
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
        Schema::dropIfExists('atividades');
    }
}
