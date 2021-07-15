<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeyCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_compras', function ( $table) {
            $table->unsignedBigInteger('id_contrato');
            $table->foreign('id_contrato')-> references('id')->on('contratos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orden_compras',function(Blueprint $table){
            $table->dropForeign(['id_contrato']);
        });
    }
}
