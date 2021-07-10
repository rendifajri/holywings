<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    'name' => 'Rendi Fajrianto',
                    'phone' => '085726100714',
                    'address' => 'Jl. Pancurawis Purwokerto Selatan',
                ];
        Customer::create($data);
        $data = [
                    [
                        'code' => 'F001',
                        'name' => 'Chicken',
                        'price' => 35000
                    ],
                    [
                        'code' => 'B001',
                        'name' => 'Coca Cola',
                        'price' => 35000
                    ],
                ];
        Item::insert($data);
    }
}
