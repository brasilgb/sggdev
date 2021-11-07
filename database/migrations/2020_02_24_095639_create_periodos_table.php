<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('periodos', function (Blueprint $table) {
            $table->integer('id_periodo')->primary();
            $table->timestamp('data_inicial');
            $table->integer('semana_inicial');
            $table->integer('semana_final');
            $table->integer('ativo');
            $table->timestamps();
            $table->timestamp('desativacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('periodos');
    }

}
