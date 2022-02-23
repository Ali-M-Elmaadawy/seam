<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name' => 's1',
            'price' => 20
        ]);

        Item::create([
            'name' => 's2',
            'price' => 30
        ]);

        Item::create([
            'name' => 's3',
            'price' => 40
        ]);
    }
}
