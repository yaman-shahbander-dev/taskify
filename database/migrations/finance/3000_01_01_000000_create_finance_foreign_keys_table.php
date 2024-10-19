<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       if (Schema::hasTable('invoice_items')) {
           Schema::table('invoice_items', function (Blueprint $table) {
               $table->foreign('invoice_id')
                   ->references('id')
                   ->on('invoices')
                   ->cascadeOnUpdate()
                   ->cascadeOnDelete();
           });
       }

        if (Schema::hasTable('payment_transactions')) {
            Schema::table('payment_transactions', function (Blueprint $table) {
                $table->foreign('invoice_id')
                    ->references('id')
                    ->on('invoices')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropForeign('invoice_items_invoice_id_foreign');
        });

        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropForeign('payment_transactions_invoice_id_foreign');
        });
    }
};
