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
        if (Schema::hasTable('companies_departments')) {
            Schema::table('companies_departments', function (Blueprint $table) {
                $table->foreign('company_id')
                    ->references('id')
                    ->on('companies')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('departments_teams')) {
            Schema::table('departments_teams', function (Blueprint $table) {
                $table->foreign('department_id')
                    ->references('id')
                    ->on('companies_departments')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('teams_members')) {
            Schema::table('teams_members', function (Blueprint $table) {
                $table->foreign('team_id')
                    ->references('id')
                    ->on('departments_teams')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('team_member_roles')) {
            Schema::table('team_member_roles', function (Blueprint $table) {
                $table->foreign('team_member_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('salaries')) {
            Schema::table('salaries', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('currency_id')
                    ->references('id')
                    ->on('currencies')
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
        Schema::table('companies_departments', function (Blueprint $table) {
            $table->dropForeign('companies_departments_company_id_foreign');
        });

        Schema::table('departments_teams', function (Blueprint $table) {
            $table->dropForeign('departments_teams_department_id_foreign');
        });

        Schema::table('teams_members', function (Blueprint $table) {
            $table->dropForeign('teams_members_team_id_foreign');
            $table->dropForeign('teams_members_user_id_foreign');
        });

        Schema::table('team_member_roles', function (Blueprint $table) {
            $table->dropForeign('team_member_roles_team_member_id_foreign');
            $table->dropForeign('team_member_roles_role_id_foreign');
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->dropForeign('salaries_user_id_foreign');
            $table->dropForeign('salaries_currency_id_foreign');
        });
    }
};
