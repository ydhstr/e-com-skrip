<?php

namespace Database\Seeders;
use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'name' => 'Administrator',
            'email' => '',
            'password' => bcrypt('123'),
            'email_verified_at' => now()
        ]);
    }
}
