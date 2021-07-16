<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOrdenCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_compras', function($table) {
            $table->unsignedBigInteger('id_proveedor');
            $table->date('fecha_entrega');
            $table->string("observaciones");
            $table->foreign("id_proveedor")->references("id")->on("proveedores");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orden_compras', function($table) {
            
            $table->dropForeign("id_proveedor");
            $table->dropColumn('id_proveedor');
            $table->dropColumn('fecha_entrega');
            $table->dropColumn('observaciones');
            

        });
    }
}
