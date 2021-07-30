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
        $faker = Faker\Factory::create();
        for ($i=0; $i <10 ; $i++) { 
            Product::create([
                'title' => $faker->sentence(4),
                'slug' => $faker->slug,
                'subtitle' => $faker->sentence(3),
                'description' => $faker->text,
                'price' => $faker->numberBetween(500, 2000),
                'image' => "https://via.placeholder.com/200x250"
            ])->categories()->attach([
                rand(1, 3),
                rand(1, 3)
            ]);
        }
    }
}
