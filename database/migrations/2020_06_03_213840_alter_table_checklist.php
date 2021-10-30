<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableChecklist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::table('checklists', function (Blueprint $table) {
            $table->integer('periodo')->after('id_checklist');
            $table->foreign('periodo')->references('id_periodo')->on('periodos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('checklists', function (Blueprint $table) {
            $table->dropForeign('checklists_periodo_foreign');
            $table->dropColumn('periodo');
        });
    }
}
