<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OncascadCuentasRelacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relacion_cuentas',function(Blueprint $table){
            DB::statement("ALTER TABLE `constructora`.`relacion_cuentas` 
            DROP FOREIGN KEY `relacion_cuentas_cuenta_id_foreign`;");
            DB::statement("ALTER TABLE `constructora`.`relacion_cuentas` 
            ADD CONSTRAINT `relacion_cuentas_cuenta_id_foreign`
              FOREIGN KEY (`cuenta_id`)
              REFERENCES `constructora`.`credito_cuentas` (`id`)
              ON DELETE CASCADE;");
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
