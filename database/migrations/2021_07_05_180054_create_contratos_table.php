<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            /*$table->string('calle_contratante');
            $table->integer('numero_contratante');
            $table->string('colonia_contratante');
            $table->integer('cp_contratante');*/
            $table->string('nombre_contraparte');
            $table->string('folio');
            $table->string('descripcion');
            $table->float('anticipo');
            $table->date('fecha_anticipo');
            $table->float('monto');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->string('calle_contraparte');
            $table->integer('numero_contraparte');
            $table->string('colonia_contraparte');
            $table->string('localidad');
            $table->integer('cp_contraparte');    
            $table->string('file');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
