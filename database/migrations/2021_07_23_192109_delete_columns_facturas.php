<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnsFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facturas',function($table){
            $table->dropColumn('numero_factura');
            $table->dropColumn('id_contrato');
            $table->dropColumn('importe_construccion');
            $table->dropColumn('nombre_contratante');
            $table->dropColumn('calle_contratante');
            $table->dropColumn('numero_contratante');
            $table->dropColumn('colonia_contratante');
            $table->dropColumn('cp_contratante');
            $table->dropColumn('nombre_contraparte');
            $table->dropColumn('calle_contraparte');
            $table->dropColumn('numero_contraparte');
            $table->dropColumn('colonia_contraparte');
            $table->dropColumn('cp_contraparte');
            $table->dropColumn('fecha_cnstruccion');
            $table->dropColumn('nombre_construccions');
            $table->dropColumn('calle_construccion');
            $table->dropColumn('numero_cnstruccion');
            $table->dropColumn('colonia_construccion');
            $table->dropColumn('cp_construccion');
            $table->dropColumn('pago_construccion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
