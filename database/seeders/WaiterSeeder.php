<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Waiter;
class WaiterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Waiter::create([
            'waiter_name' => 'Ali'
        ]);

        Waiter::create([
            'waiter_name' => 'Mohamed'
        ]);

        Waiter::create([
            'waiter_name' => 'Ibrahim'
        ]);
    }
}
