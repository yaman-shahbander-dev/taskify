<?php

namespace Database\Seeders\finance;

use Database\Factories\finance\InvoiceItemFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invoice_items')->truncate();
        InvoiceItemFactory::new()->count(20)->create();
    }
}
