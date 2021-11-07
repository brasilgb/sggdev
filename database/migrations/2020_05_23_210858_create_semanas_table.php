<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semanas', function (Blueprint $table) {
            $table->bigIncrements('id_semana');
            $table->integer('semana');
            $table->timestamp('data_inicial');
            $table->timestamp('data_final');
            $table->decimal('eclosao', 10,2)->nullable();
            $table->decimal('fertilidade', 10,2)->nullable();
            $table->decimal('producao', 10,2)->nullable();
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
        Schema::dropIfExists('semanas');
    }
}
