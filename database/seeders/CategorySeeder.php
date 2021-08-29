<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,5) as $value) {
            DB::table('categories')->insert([
                'title' => $faker->title(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
