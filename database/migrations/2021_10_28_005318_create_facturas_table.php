<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nro_fact");
            $table->string("ent_sal_fact");
            $table->string("fact_Bol");
            $table->string("nom_cli")->nullable();
            $table->string("nom_prov")->nullable();
            $table->string("nom_em");
            $table->string("fecha_fac");
            $table->string('estado');
        });
        Schema::table('facturas', function (Blueprint $table) {
            $table->unsignedBigInteger("fact_id_user");
            $table->foreign("fact_id_user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
