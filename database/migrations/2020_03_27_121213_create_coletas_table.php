<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coletas', function (Blueprint $table) {
            $table->integer('id_coleta')->primary();
            $table->integer('id_aviario');
            $table->integer('periodo');
            $table->integer('coleta');
            $table->date('data_coleta');
            $table->time('hora_coleta');
            $table->integer('limpos_ninho');
            $table->integer('sujos_ninho');
            $table->integer('ovos_cama');
            $table->integer('duas_gemas');
            $table->integer('refugos')->nullable();
            $table->integer('pequenos')->nullable();
            $table->integer('casca_fina')->nullable();
            $table->integer('frios')->nullable();
            $table->integer('esmagados_quebrados')->nullable();
            $table->integer('cama_nao_incubaveis')->nullable();
            $table->integer('deformados');
            $table->integer('sujos_cama');
            $table->integer('trincados');
            $table->integer('eliminados')->nullable();
            $table->integer('incubaveis_bons');
            $table->integer('incubaveis');
            $table->integer('comerciais');
            $table->integer('postura_dia');
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
        Schema::dropIfExists('coletas');
    }
}
