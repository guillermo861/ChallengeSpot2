<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropierties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('propierties', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'codigo_postal', 5);
            $table->double( 'superficie_terreno');
            $table->double( 'superficie_construccion');
            $table->integer( 'uso_construccion'    );
            $table->float( 'valor_unitario_suelo');
            $table->float( 'valor_suelo');
            $table->float( 'subsidio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propierties');
    }
}
