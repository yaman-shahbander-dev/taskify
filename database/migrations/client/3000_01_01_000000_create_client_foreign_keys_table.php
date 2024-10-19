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
        if (Schema::hasTable('user_skills')) {
            Schema::table('user_skills', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreign('skill_id')
                    ->references('id')
                    ->on('skills')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreign('proficiency_level_id')
                    ->references('id')
                    ->on('proficiency_levels')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('user_tasks')) {
            Schema::table('user_tasks', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreign('task_id')
                    ->references('id')
                    ->on('tasks')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('user_sprint_assignments')) {
            Schema::table('user_sprint_assignments', function (Blueprint $table) {
                $table->foreign('sprint_id')
                    ->references('id')
                    ->on('sprints')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreign('task_id')
                    ->references('id')
                    ->on('tasks')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::table('user_skills', function (Blueprint $table) {
            $table->dropForeign('user_skills_user_id_foreign');
            $table->dropForeign('user_skills_skill_id_foreign');
            $table->dropForeign('user_skills_proficiency_level_id_foreign');
        });

        Schema::table('user_tasks', function (Blueprint $table) {
            $table->dropForeign('user_tasks_user_id_foreign');
            $table->dropForeign('user_tasks_task_id_foreign');
        });

        Schema::table('user_sprint_assignments', function (Blueprint $table) {
            $table->dropForeign('user_sprint_assignments_sprint_id_foreign');
            $table->dropForeign('user_sprint_assignments_task_id_foreign');
            $table->dropForeign('user_sprint_assignments_user_id_foreign');
        });
    }
};
