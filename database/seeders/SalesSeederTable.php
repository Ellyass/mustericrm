<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales')->insert([
            'sales_buy' => 5000,
            'sales_sell' => 6000,
            'sales_second_sell' => 5500,
            'sales_pcb' => 5,
            'sales_point' => 27500,
            'sales_earning' => 2500
        ]);
    }
}
