<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMortalidadesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('mortalidades', function (Blueprint $table) {
            $table->integer('id_mortalidade')->primary();
            $table->string('id_aviario');
            $table->integer('periodo');
            $table->date('data_mortalidade');
            $table->integer('femea_box1');
            $table->integer('femea_box2')->nullable();
            $table->integer('femea_box3')->nullable();
            $table->integer('femea_box4')->nullable();
            $table->integer('macho_box1');
            $table->integer('macho_box2')->nullable();
            $table->integer('macho_box3')->nullable();
            $table->integer('macho_box4')->nullable();
            $table->integer('femea');
            $table->integer('macho');
            $table->integer('tot_ave');
            $table->integer('motivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('mortalidades');
    }

}
