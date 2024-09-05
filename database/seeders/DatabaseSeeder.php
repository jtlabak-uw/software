<?php

namespace Database\Seeders;

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
    }
}
