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
        Schema::create('sprint_tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sprint_id');
            $table->foreignUuid('task_id');
            $table->foreignUuid('priority_id');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sprint_tasks');
    }
};