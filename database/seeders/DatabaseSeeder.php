<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Expand;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::create([
            'name' => 'Nila',
            'email' => 'nila@gmail.com',
            'password' => '123456',
        ]);

        Category::create([
            'name' => 'makanan',
        ]);

        Category::create([
            'name' => 'properti',
        ]);

        Product::create([
            'name' => 'pur 12',
            'barcode' => 12345678,
            'image' => 'allalala.png',
            'categories_id' => 1,
            'cons_price' => 9000,
            'selling_price' => 12000,
            'status' => 'active',
            'expired' => '2026/10/20'
        ]);

        Product::create([
            'name' => 'kandang perkutut',
            'barcode' => 12345679,
            'categories_id' => 2,
            'cons_price' => 5000,
            'selling_price' => 7000,
            'status' => 'active',
        ]);

        StockIn::create([
            'users_id' => 1,
            'products_id' => 2,
            'quantity' => 10,
            'cons_price' => 5000,
        ]);

        StockOut::create([
            'users_id' => 1,
            'products_id' => 2,
            'quantity' => 1,
            'selling_price' => 7000,
        ]);

        Expand::create([
            'users_id' => 1,
            'desc' => 'belanja',
            'nominal' => 100000
        ]);
    }
}
