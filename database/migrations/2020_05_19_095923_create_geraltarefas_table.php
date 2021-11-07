<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeralTarefasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('geraltarefas', function (Blueprint $table) {
            $table->integer('id_tarefa')->primary();
            $table->integer('periodo');
            $table->timestamp('data_inicio');
            $table->time('hora_inicio');
            $table->timestamp('data_previsao');
            $table->time('hora_previsao');
            $table->string('descritivo');
            $table->text('descricao');
            $table->timestamp('data_termino')->nullable();
            $table->time('hora_termino')->nullable();
            $table->string('situacao');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('geraltarefas');
    }

}
