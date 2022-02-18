<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("prod_inv");
            $table->integer("entrada_inv")->nullable();
            $table->integer("salida_inv")->nullable();
            $table->integer("stock_inv")->nullable();
            $table->integer("precio_inv");
            $table->integer("importe_inv")->nullable();
            $table->string('estado');
        });
        Schema::table('inventarios', function (Blueprint $table) {
            $table->unsignedBigInteger("inv_id_user");
            $table->foreign("inv_id_user")->references("id")->on("users");
            $table->unsignedBigInteger("inv_id_productos");
            $table->foreign("inv_id_productos")->references("id")->on("productos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarios');
    }
}
