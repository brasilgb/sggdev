<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controlediarios', function (Blueprint $table) {
            $table->integer('id_controle')->primary();
            $table->date('data_controle');
            $table->integer('periodo');
            $table->integer('aviario');
            $table->decimal('temperatura_max', 10,2);
            $table->decimal('temperatura_min', 10,2);
            $table->decimal('umidade', 10,2);
            $table->integer('leitura_agua');
            $table->integer('consumo_total');
            $table->decimal('consumo_ave', 10,2);
            $table->integer('valorinicial');
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
        Schema::dropIfExists('controlediarios');
    }
}
