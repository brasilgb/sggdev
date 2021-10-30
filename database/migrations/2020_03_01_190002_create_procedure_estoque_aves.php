<?php

use Illuminate\Database\Migrations\Migration;

class CreateProcedureEstoqueAves extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::unprepared('
DROP PROCEDURE IF EXISTS `SP_AtualizaEstoqueAves`;            
CREATE PROCEDURE `SP_AtualizaEstoqueAves` (
IN `SP_aviario` INT(10),
IN `SP_periodo` INT(10),
IN `SP_data_estoque` date,
IN `SP_lote` INT(10),
IN `SP_femea_box1` INT(10),
IN `SP_femea_box2` INT(10),
IN `SP_femea_box3` INT(10),
IN `SP_femea_box4` INT(10),
IN `SP_macho_box1` INT(10),
IN `SP_macho_box2` INT(10),
IN `SP_macho_box3` INT(10),
IN `SP_macho_box4` INT(10),
IN `SP_femea` INT(10),
IN `SP_macho` INT(10),
IN `SP_tot_ave` INT(10)
)

BEGIN
declare contador int(10);
select count(*) into contador from estoque_aves where  id_aviario = SP_aviario;

if contador > 0 then
update estoque_aves set 
id_aviario = SP_aviario, 
periodo = SP_periodo, 
data_estoque = SP_data_estoque, 
lote = SP_lote,  
femea_box1 = femea_box1 + SP_femea_box1, 
femea_box2 = femea_box2 + SP_femea_box2, 
femea_box3 = femea_box3 + SP_femea_box3, 
femea_box4 = femea_box4 + SP_femea_box4, 
macho_box1 = macho_box1 + SP_macho_box1, 
macho_box2 = macho_box2 + SP_macho_box2, 
macho_box3 = macho_box3 + SP_macho_box3, 
macho_box4 = macho_box4 + SP_macho_box4, 
femea = femea + SP_femea,
macho = macho + SP_macho,
tot_ave = tot_ave + SP_tot_ave
where id_aviario = SP_aviario;
else
insert into estoque_aves (
id_aviario, 
periodo,
data_estoque,
lote, 
femea_box1,
femea_box2,
femea_box3,
femea_box4,
macho_box1,
macho_box2,
macho_box3,
macho_box4,
femea, 
macho,
tot_ave
) values(
SP_aviario, 
SP_periodo,
SP_data_estoque,
SP_lote,
SP_femea_box1, 
SP_femea_box2, 
SP_femea_box3, 
SP_femea_box4, 
SP_macho_box1,
SP_macho_box2,
SP_macho_box3,
SP_macho_box4,
SP_femea,
SP_macho,
SP_tot_ave
);
end if;
END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_AtualizaEstoqueAves`');
    }

}
