<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Faker\Factory as Faker;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$faker = Faker::create('id_ID');

    	foreach (range(1, 15) as $index) {
    		Event::create([
    			'title' => $faker->sentence,
    			'description' => $faker->paragraph,
    			'event_date' => $faker->dateTimeBetween('now', '+1 year'),
    			'location' => $faker->address,
    			'image' => $faker->imageUrl(640, 480, 'events'),
    		]);
    	}
    }
}
