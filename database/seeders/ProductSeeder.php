<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(    [
            'category_id'=> 1,
            'name' => 'Geometrique',
            'description' => 'An elegant and hypnotic 3-panel headboard and bed base set, designed with a headboard featuring 15 upholstered panes in irregular',
            'price' => 2000,
            'stock_quantity' => 10,
            'image'=> '',]);
    }
}
