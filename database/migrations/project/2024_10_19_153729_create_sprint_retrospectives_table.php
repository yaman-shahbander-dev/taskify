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
        Schema::create('sprint_retrospectives', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sprint_id');
            $table->timestamp('date');
            $table->text('what_went_well');
            $table->text('what_can_improve');
            $table->text('action_items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sprint_retrospectives');
    }
};
