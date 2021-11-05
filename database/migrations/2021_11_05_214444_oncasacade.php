<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Oncasacade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_pagos',function(Blueprint $table){
            DB::statement("ALTER TABLE orden_pagos
            DROP FOREIGN KEY orden_pagos_id_pago_foreign;");
            DB::statement("ALTER TABLE orden_pagos
            ADD CONSTRAINT orden_pagos_id_pago_foreign
              FOREIGN KEY (id_pago)
              REFERENCES pagos_proveedores2s (id)
              ON DELETE CASCADE");
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
