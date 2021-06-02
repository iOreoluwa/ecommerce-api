<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Tag::create([
                'name' => $faker->domainWord,
                'slug' => $faker->slug,
                // 'description' => $faker->paragraph,
            ]);
        }
    }
}
