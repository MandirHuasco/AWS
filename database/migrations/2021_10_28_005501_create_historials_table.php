<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nom_trab_hist");
            $table->string("accion_hist");
            $table->string("fecha_hist");
            $table->string("estado_adm_hist");
            $table->string('estado');
        });
        Schema::table('historials', function (Blueprint $table) {
            $table->unsignedBigInteger("hist_id_user");
            $table->foreign("hist_id_user")->references("id")->on("users");
            $table->unsignedBigInteger("hist_id_productos");
            $table->foreign("hist_id_productos")->references("id")->on("productos");
            $table->unsignedBigInteger("hist_id_entradas");
            $table->foreign("hist_id_entradas")->references("id")->on("entradas");
            $table->unsignedBigInteger("hist_id_salidas");
            $table->foreign("hist_id_salidas")->references("id")->on("salidas");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historials');
    }
}
