<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVoboAutorizacionOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_compras', function($table) {
            $table->string('vobo');
            $table->string('autorizacion');
            $table->float('iva');
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
            $table->dropColumn('vobo');
            $table->dropColumn('autorizacion');
            $table->dropColumn('iva');
        });
    }
}
