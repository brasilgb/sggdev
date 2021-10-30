<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpdateAviario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
CREATE TRIGGER `TRG_update_aviarios` AFTER UPDATE ON `aviarios`
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.data_aviario,
      new.lote_id, 
      new.femea_box1 - old.femea_box1,
      new.femea_box2 - old.femea_box2,
      new.femea_box3 - old.femea_box3,
      new.femea_box4 - old.femea_box4,
      new.macho_box1 - old.macho_box1,
      new.macho_box2 - old.macho_box2,
      new.macho_box3 - old.macho_box3,
      new.macho_box4 - old.macho_box4,
      new.femea - old.femea, 
      new.macho - old.macho,
      new.tot_ave - old.tot_ave
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
        DB::unprepared('DROP TRIGGER `TRG_update_aviarios`');
    }
}
