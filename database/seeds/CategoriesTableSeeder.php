<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Fruits',
            'slug' => 'fruits'
        ]);

        Category::create([
            'name' => 'Légumes',
            'slug' => 'legumes'
        ]);

        Category::create([
            'name' => 'Fruits & Légumes',
            'slug' => 'fruits-legumes'
        ]);
    }
}
