<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;
class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Table::create([
            'table_number' => 1
        ]);

        Table::create([
            'table_number' => 2
        ]);

        Table::create([
            'table_number' => 3
        ]);
    }
}
