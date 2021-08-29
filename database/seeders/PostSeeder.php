<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,25) as $value) {
            DB::table('posts')->insert([
                'title' => $faker->title(),
                'image' => $faker->imageUrl('public/storage/images', 640, 480, null, false),
                'description' => $faker->text(),
                'category_id' => rand(1,5),
                'user_id' => rand(1,15),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
