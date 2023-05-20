<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\ProductOrder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Category::factory(10)->create();
        // Product::factory(50)->create();
        // Order::factory(5)->create();
        // ProductOrder::factory(60)->create();
    }
}
