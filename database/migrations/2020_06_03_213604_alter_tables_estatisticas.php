<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesEstatisticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('semanas', function (Blueprint $table) {
            $table->integer('periodo')->after('id_semana');
            $table->foreign('periodo')->references('id_periodo')->on('periodos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('semanas', function (Blueprint $table) {
            $table->dropForeign('semanas_periodo_foreign');
            $table->dropColumn('periodo');
        });
    }
}
