<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeingKeyProveedorContactoventa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('proveedor_contacto_ventas', function ( $table) {
            $table->unsignedBigInteger('id_proveedor');
            $table->foreign('id_proveedor')-> references('id')->on('proveedores')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proveedor_contacto_ventas',function(Blueprint $table){
            $table->dropForeign(['id_proveedor']);
        });
    }
}
