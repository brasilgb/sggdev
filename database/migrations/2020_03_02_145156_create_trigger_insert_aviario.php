<?php

use Illuminate\Database\Migrations\Migration;

class CreateTriggerInsertAviario extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
CREATE TRIGGER `TRG_insert_aviarios` AFTER INSERT ON `aviarios` 
FOR EACH ROW 
BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.data_aviario,
      new.lote_id, 
      new.femea_box1,
      new.femea_box2,
      new.femea_box3,
      new.femea_box4,
      new.macho_box1,
      new.macho_box2,
      new.macho_box3,
      new.macho_box4,
      new.femea, 
      new.macho,
      new.tot_ave
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
        DB::unprepared('DROP TRIGGER `TRG_insert_aviarios`');
    }

}
