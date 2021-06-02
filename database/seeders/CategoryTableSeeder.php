<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->domainWord,
                'slug' => $faker->slug,
                'description' => $faker->paragraph,
                'image_url' => $faker->imageUrl(100, 100, 'cats'),
            ]);
        }
    }
}
