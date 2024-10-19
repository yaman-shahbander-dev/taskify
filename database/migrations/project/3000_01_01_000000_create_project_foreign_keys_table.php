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
        if (Schema::hasTable('projects')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->foreign('company_id')
                    ->references('id')
                    ->on('companies')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('department_id')
                    ->references('id')
                    ->on('companies_departments')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('tasks')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('priority_id')
                    ->references('id')
                    ->on('priority_levels')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('assigned_to')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('meetings')) {
            Schema::table('meetings', function (Blueprint $table) {
                $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('sprints')) {
            Schema::table('sprints', function (Blueprint $table) {
                $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('sprint_tasks')) {
            Schema::table('sprint_tasks', function (Blueprint $table) {
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

                $table->foreign('priority_id')
                    ->references('id')
                    ->on('priority_levels')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('sprint_reviews')) {
            Schema::table('sprint_reviews', function (Blueprint $table) {
                $table->foreign('sprint_id')
                    ->references('id')
                    ->on('sprints')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('sprint_retrospectives')) {
            Schema::table('sprint_retrospectives', function (Blueprint $table) {
                $table->foreign('sprint_id')
                    ->references('id')
                    ->on('sprints')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('sprint_changes_log')) {
            Schema::table('sprint_changes_log', function (Blueprint $table) {
                $table->foreign('sprint_id')
                    ->references('id')
                    ->on('sprints')
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
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_company_id_foreign');
            $table->dropForeign('projects_department_id_foreign');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_project_id_foreign');
            $table->dropForeign('tasks_priority_id_foreign');
            $table->dropForeign('tasks_assigned_to_foreign');
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->dropForeign('meetings_project_id_foreign');
        });

        Schema::table('sprints', function (Blueprint $table) {
            $table->dropForeign('sprints_project_id_foreign');
        });

        Schema::table('sprint_tasks', function (Blueprint $table) {
            $table->dropForeign('sprint_tasks_sprint_id_foreign');
            $table->dropForeign('sprint_tasks_task_id_foreign');
            $table->dropForeign('sprint_tasks_priority_id_foreign');
        });

        Schema::table('sprint_reviews', function (Blueprint $table) {
            $table->dropForeign('sprint_reviews_sprint_id_foreign');
        });

        Schema::table('sprint_retrospectives', function (Blueprint $table) {
            $table->dropForeign('sprint_retrospectives_sprint_id_foreign');
        });

        Schema::table('sprint_changes_log', function (Blueprint $table) {
            $table->dropForeign('sprint_changes_log_sprint_id_foreign');
        });
    }
};
