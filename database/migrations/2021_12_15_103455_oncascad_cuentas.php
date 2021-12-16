<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OncascadCuentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credito_cuentas',function(Blueprint $table){
            DB::statement("ALTER TABLE `constructora`.`credito_cuentas` 
            DROP FOREIGN KEY `credito_cuentas_id_proveedor_foreign`;");
            DB::statement("ALTER TABLE `constructora`.`credito_cuentas` 
            ADD CONSTRAINT `credito_cuentas_id_proveedor_foreign`
              FOREIGN KEY (`id_proveedor`)
              REFERENCES `constructora`.`proveedores` (`id`)
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
