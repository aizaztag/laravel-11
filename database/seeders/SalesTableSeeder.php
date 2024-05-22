<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::all()->each(function ($customer) {
            Sale::factory(5)->create(['customer_id' => $customer->id]);
        });
    }
}
