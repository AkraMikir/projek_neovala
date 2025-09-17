<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Koneksi ke database SQLite
        $sqlite = DB::connection('sqlite');

        // Ambil data dari SQLite
        $products = $sqlite->table('products')->get();
        $customers = $sqlite->table('customers')->get();
        $sales = $sqlite->table('sales')->get();
        $saleDetails = $sqlite->table('sale_details')->get();

        // Pindahkan data products
        foreach ($products as $product) {
            Product::create((array) $product);
        }

        // Pindahkan data customers
        foreach ($customers as $customer) {
            Customer::create((array) $customer);
        }

        // Pindahkan data sales
        foreach ($sales as $sale) {
            Sale::create((array) $sale);
        }

        // Pindahkan data sale_details
        foreach ($saleDetails as $detail) {
            SaleDetail::create((array) $detail);
        }
    }
}
