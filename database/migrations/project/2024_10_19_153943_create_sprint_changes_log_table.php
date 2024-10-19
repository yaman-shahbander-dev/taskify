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
        Schema::create('sprint_changes_log', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sprint_id');
            $table->text('change_description');
            $table->timestamp('date');
            $table->text('affected_tasks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sprint_changes_log');
    }
};
