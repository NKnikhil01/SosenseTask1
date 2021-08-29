<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $value) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'is_admin' => 1,
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]); 
        }
        foreach (range(1,5) as $value) {
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'is_admin' => 0,
                'password' => Hash::make('user1234'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
