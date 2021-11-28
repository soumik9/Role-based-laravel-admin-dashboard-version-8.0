<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = Currency::Where('code', 'BDT')->first();
        if(is_null($currency))
        {
            Currency::create([
                'name'   => 'Bangladeshi Taka',
                'code'   => 'BDT',
                'symbol' => '৳',
                'status' => 1
            ]);
        }
    }
}
