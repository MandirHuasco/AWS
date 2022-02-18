<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("prod_sal");
            $table->integer("cant_sal");
            $table->float("pre_sal");
            $table->float("total_sal");
            $table->float("margen_ganancia_porcentaje_sal")->nullable();
            $table->float("margen_ganancia_unit_sal");
            $table->float("margen_ganancia_total_sal");
            $table->float("valor_unid_sal");
            $table->float("valor_total_sal");
            $table->integer("IGV_unit_sal")->nullable();
            $table->float("IGV_total_sal")->nullable();
            $table->float("precio_publico_unid_sal");
            $table->float("precio_publico_total_sal");
            $table->string('estado');
        });
        Schema::table('salidas', function (Blueprint $table) {
            $table->unsignedBigInteger("sal_id_user");
            $table->foreign("sal_id_user")->references("id")->on("users");
            $table->unsignedBigInteger("fact_id_salidas");
            $table->foreign("fact_id_salidas")->references("id")->on("facturas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salidas');
    }
}
