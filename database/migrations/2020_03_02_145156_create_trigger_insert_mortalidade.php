<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerInsertMortalidade extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
CREATE TRIGGER `TRG_insert_mortalidades` AFTER INSERT ON `mortalidades` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.data_mortalidade,
      new.lote_id, 
      new.femea_box1 * -1,
      new.femea_box2 * -1,
      new.femea_box3 * -1,
      new.femea_box4 * -1,
      new.macho_box1 * -1,
      new.macho_box2 * -1,
      new.macho_box3 * -1,
      new.macho_box4 * -1,
      new.femea * -1, 
      new.macho * -1,
      new.tot_ave * -1
      );
END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP TRIGGER `TRG_insert_mortalidades`');
    }

}
