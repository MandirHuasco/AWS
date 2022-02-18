<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("prod_entr");
            $table->integer("cant_entr");
            $table->float("pre_entr");
            $table->float("total_entr");
            $table->float("desc_entr")->nullable();
            $table->float("importe_desc_entr")->nullable();
            $table->float("valor_compra_neto_entr");
            $table->float("flete_unidad_entr")->nullable();
            $table->float("flete_total_entr")->nullable();
            $table->float("recargo_porcentaje_entr")->nullable();
            $table->float("total_recargo_entr")->nullable();
            $table->float("costo_adqu_unid_entr");
            $table->float("costo_adqu_total_entr");
            $table->string('estado');
        });
        Schema::table('entradas', function (Blueprint $table) {
            $table->unsignedBigInteger("entr_id_user");
            $table->foreign("entr_id_user")->references("id")->on("users");
            $table->unsignedBigInteger("fact_id_entradas");
            $table->foreign("fact_id_entradas")->references("id")->on("facturas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas');
    }
}
