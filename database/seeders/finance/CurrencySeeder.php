<?php

namespace Database\Seeders\finance;

use Database\Factories\company\CompanyFactory;
use Database\Factories\finance\CurrencyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->truncate();
        CurrencyFactory::new()->count(100)->make()->each(function ($currency) {
            $currency->writeable()->save();
        });
    }
}
