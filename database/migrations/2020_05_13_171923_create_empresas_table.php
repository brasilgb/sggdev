<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->integer('id_empresa')->primary();
            $table->text('logotipo')->nullable();
            $table->char('cnpj', 50);
            $table->char('razao_social', 50);
            $table->integer('segmento')->nullable();
            $table->char('endereco', 50);
            $table->char('cidade', 50);
            $table->string('uf');
            $table->char('telefone', 15)->nullable();
            $table->char('celular', 15);
            $table->char('email', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
