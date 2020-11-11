<?php

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10 ; $i++) { 
            Product::create([
                'code' => 'FILTRO-'.($i+1),
                'description' => 'Ejemplo de descripcion filtro'.($i+1),
                'buy_price' => 100+$i+1,
                'sell_price' => 125+$i+1,
                'wholesale_price' => 115+$i+1,
                'agency_1_stock' => 0,
                'agency_2_stock' => 0,
                'total_stock' => 0,
                'image_url' => '',
            ]);

        }              
    }
}

