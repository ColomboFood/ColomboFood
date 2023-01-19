<?php

namespace Database\Seeders;

use App\Models\ShippingPrice;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingPrice::create([
            'name'          => 'Standard',
            'description'   => 'Consegna entro 2-4 giorni',
            'price'         => 0.00, 
            'active'        => true,
            'min_price'     => 50.00
        ]);

        ShippingPrice::create([
            'name'          => 'Express',
            'description'   => 'Consegna in 48h',
            'price'         => 10.00,  
            'active'         => true, 
        ]);
    }
}
