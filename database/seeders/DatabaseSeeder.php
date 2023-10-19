<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\OrderBillingAddress;
use App\Models\OrderProduct;
use App\Models\OrderShippingAddress;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for($i = 0; $i <10;$i++){
            $order = Order::factory()
                ->create();

            OrderProduct::factory()
                ->count(rand(1,8))
                ->for($order)
                ->create();

            OrderShippingAddress::factory()
                ->for($order)
                ->create();

            OrderBillingAddress::factory()
                ->for($order)
                ->create();
        }
    }
}
