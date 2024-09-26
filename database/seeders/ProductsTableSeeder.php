<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$faker = Faker::create('id_ID');

    	foreach (range(1, 20) as $index) {
    		Product::create([
    			'name' => $faker->word,
    			'price' => $faker->numberBetween(100, 1000),
    			'category_id' => $faker->numberBetween(1, 5),
    			'stock' => $faker->numberBetween(1, 100),
    			'image' => $faker->imageUrl(640, 480, 'products'),
    		]);
    	}
    }
}
