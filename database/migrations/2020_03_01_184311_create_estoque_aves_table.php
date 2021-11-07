<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoqueAvesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('estoque_aves', function (Blueprint $table) {
            $table->bigIncrements('id_estoque');
            $table->integer('id_aviario');
            $table->integer('periodo');
            $table->timestamp('data_estoque');
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
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('estoque_aves');
    }

}
