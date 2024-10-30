<?php

namespace Database\Seeders\finance;

use Database\Factories\finance\InvoiceFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('invoices')->truncate();
        InvoiceFactory::new()->count(100)->make()->each(function ($invoice) {
            $invoice->writeable()->save();
        });
    }
}
