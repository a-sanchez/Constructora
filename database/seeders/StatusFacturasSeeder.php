<?php

namespace Database\Seeders;

use App\Models\status;
use Illuminate\Database\Seeder;

class StatusFacturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        status::create(['status'=>'En proceso..']);
        status::create(['status'=>'Operada']);
        status::create(['status'=>'Pagada']);
    }
}
