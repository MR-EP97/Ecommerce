<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\FeatureFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CustomerSeeder::class,
            SellerSeeder::class,
            CategorySeeder::class,
            FeatureFactory::class,
            ProductSeeder::class,
        ]);
    }
}
