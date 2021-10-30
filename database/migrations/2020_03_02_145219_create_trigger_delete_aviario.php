<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerDeleteAviario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
CREATE TRIGGER `TRG_delete_aviarios` AFTER DELETE ON `aviarios` FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      old.id_aviario, 
      old.periodo, 
      old.data_aviario,
      old.lote_id, 
      old.femea_box1 * -1,
      old.femea_box2 * -1,
      old.femea_box3 * -1,
      old.femea_box4 * -1,
      old.macho_box1 * -1,
      old.macho_box2 * -1,
      old.macho_box3 * -1,
      old.macho_box4 * -1,
      old.femea * -1, 
      old.macho * -1,
      old.tot_ave * -1
      );
END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `TRG_delete_aviarios`');
    }
}
