<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['Hardcopy', 'Digital', 'Download'];

        foreach ($products as $product) {
        	      
        	Product::insert([
        		'name' => $product
        	]);
        }	
    }
}
