<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateMortalidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
CREATE TRIGGER `TRG_update_mortalidades` AFTER UPDATE ON `mortalidades`
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.data_mortalidade,
      new.lote_id, 
      old.femea_box1 - new.femea_box1,
      old.femea_box2 - new.femea_box2,
      old.femea_box3 - new.femea_box3,
      old.femea_box4 - new.femea_box4,
      old.macho_box1 - new.macho_box1,
      old.macho_box2 - new.macho_box2,
      old.macho_box3 - new.macho_box3,
      old.macho_box4 - new.macho_box4,
      old.femea - new.femea, 
      old.macho - new.macho,
      old.tot_ave - new.tot_ave
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
        DB::unprepared('DROP TRIGGER `TRG_update_mortalidades`');
    }
}
