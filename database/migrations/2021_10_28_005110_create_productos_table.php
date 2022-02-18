<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("nom_pro");
            $table->string("desc_pro");
            $table->string("img_pro")->nullable();
            $table->string('estado');
        });
        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger("pro_id_user");
            $table->foreign("pro_id_user")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
