<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $brandName = fake()->unique()->company();

            DB::table('brands')->insert([
                'brandname'   => $brandName,
                'slug'        => Str::slug($brandName),
                'image'       => 'brand-' . rand(1, 10) . '.jpg',
                'status'      => rand(0, 1),
                'sort_order'  => $i,
                'description' => fake()->paragraph(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
