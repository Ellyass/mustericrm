<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CustomerSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'customer_name' => 'elyesa',
            'customer_city' => 'bursa',
            'customer_company_name' => 'bydent',
            'customer_official' => 'elyas',
            'customer_mail' => 'aydemirelyesa86@gmail.com',
            'customer_phone' => '05423030795',
            'customer_phone_home' => '05423030796',
            'customer_product' => 'kaporta',
            'customer_url' => 'dkfsşlfsd@hotmail.com'
        ]);
    }
}
