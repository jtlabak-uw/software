<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Software;
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
        User::factory()->create([
            'name' => 'Justin',
            'email' => 'jtlabak@uw.edu',
            'uwnetid' => 'jtlabak',
        ]);

        User::factory()->create([
            'name' => 'Brady',
            'email' => 'bradyc3@uw.edu',
            'uwnetid' => 'bradyc3',
        ]);

        $software = Software::factory(50)->create();

        for ($i = 0; $i < 25; $i++) {
            Order::factory()
                ->hasAttached($software->random(rand(1, 3)), function () {
                    $quantity = rand(1, 3);
                    $price = rand(0, 10000);
                    return [
                        'quantity' => $quantity,
                        'price' => $price,
                        'subtotal' => $quantity * $price,
                    ];
                })
                ->create();
        }
    }
}
