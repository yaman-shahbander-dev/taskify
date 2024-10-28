<?php

namespace Database\Seeders\finance;

use Database\Factories\finance\PaymentTransactionFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_transactions')->truncate();
        PaymentTransactionFactory::new()->count(50)->create();
    }
}
