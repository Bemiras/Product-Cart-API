<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        Product::create([
            'title' => 'Chocolate',
            'price' => '1.99'
        ]);

        Product::create([
            'title' => 'Chips',
            'price' => '2.99'
        ]);

        Product::create([
            'title' => 'Beer',
            'price' => '3.99'
        ]);

        Product::create([
            'title' => 'Pineapple',
            'price' => '4.99'
        ]);

        Product::create([
            'title' => 'Car',
            'price' => '5675.99'
        ]);
    }
}
