<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerDeleteMortalidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
CREATE TRIGGER `TRG_delete_mortalidades` AFTER DELETE ON `mortalidades` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      old.id_aviario, 
      old.periodo, 
      old.data_mortalidade,
      old.lote_id, 
      old.femea_box1,
      old.femea_box2,
      old.femea_box3,
      old.femea_box4,
      old.macho_box1,
      old.macho_box2,
      old.macho_box3,
      old.macho_box4,
      old.femea, 
      old.macho,
      old.tot_ave
      )
      ;
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
        DB::unprepared('DROP TRIGGER `TRG_delete_mortalidades`');
    }
}
