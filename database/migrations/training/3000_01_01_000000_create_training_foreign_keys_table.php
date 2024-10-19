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
        if (Schema::hasTable('training_courses')) {
            Schema::table('training_courses', function (Blueprint $table) {
                $table->foreign('company_id')
                    ->references('id')
                    ->on('companies')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('course_instructors')) {
            Schema::table('course_instructors', function (Blueprint $table) {
                $table->foreign('course_id')
                    ->references('id')
                    ->on('training_courses')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('instructor_id')
                    ->references('id')
                    ->on('instructors')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('training_sessions')) {
            Schema::table('training_sessions', function (Blueprint $table) {
                $table->foreign('course_id')
                    ->references('id')
                    ->on('training_courses')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('employee_training_enrollments')) {
            Schema::table('employee_training_enrollments', function (Blueprint $table) {
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('session_id')
                    ->references('id')
                    ->on('training_sessions')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('training_materials')) {
            Schema::table('training_materials', function (Blueprint $table) {
                $table->foreign('course_id')
                    ->references('id')
                    ->on('training_courses')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('attendance_records')) {
            Schema::table('attendance_records', function (Blueprint $table) {
                $table->foreign('session_id')
                    ->references('id')
                    ->on('training_sessions')
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
        Schema::table('training_courses', function (Blueprint $table) {
            $table->dropForeign('training_courses_company_id_foreign');
        });

        Schema::table('course_instructors', function (Blueprint $table) {
            $table->dropForeign('course_instructors_course_id_foreign');
            $table->dropForeign('course_instructors_instructor_id_foreign');
        });

        Schema::table('training_sessions', function (Blueprint $table) {
            $table->dropForeign('training_sessions_course_id_foreign');
        });

        Schema::table('employee_training_enrollments', function (Blueprint $table) {
            $table->dropForeign('employee_training_enrollments_user_id_foreign');
            $table->dropForeign('employee_training_enrollments_session_id_foreign');
        });

        Schema::table('training_materials', function (Blueprint $table) {
            $table->dropForeign('training_materials_course_id_foreign');
        });

        Schema::table('attendance_records', function (Blueprint $table) {
            $table->dropForeign('attendance_records_session_id_foreign');
            $table->dropForeign('attendance_records_user_id_foreign');
        });
    }
};
