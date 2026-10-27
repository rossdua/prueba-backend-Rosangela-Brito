<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'name' => 'Dólar Estadounidense',
            'symbol' => 'USD',
            'exchange_rate' => 1.0000
        ]);

        Currency::create([
            'name' => 'Euro',
            'symbol' => 'EUR',
            'exchange_rate' => 0.9200
        ]);
    }
}
