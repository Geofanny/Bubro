<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Faker\Factory as Faker;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$faker = Faker::create('id_ID');

    	foreach (range(1, 10) as $index) {
    		Gallery::create([
    			'title' => $faker->sentence,
    			'media_path' => $faker->imageUrl(640, 480, 'nature'),
    		]);
    	}
    }
}
