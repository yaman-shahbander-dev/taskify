<?php

namespace Database\Seeders;

use Database\Seeders\client\AdminRoleSeeder;
use Database\Seeders\client\AdminSeeder;
use Database\Seeders\client\PermissionSeeder;
use Database\Seeders\client\ProficiencyLevelSeeder;
use Database\Seeders\client\RolePermissionSeeder;
use Database\Seeders\client\SkillSeeder;
use Database\Seeders\client\UserSeeder;
use Database\Seeders\client\UserSkillSeeder;
use Database\Seeders\client\UserSprintAssignmentSeeder;
use Database\Seeders\client\UserTaskSeeder;
use Database\Seeders\communication\CommentSeeder;
use Database\Seeders\company\CompanyDepartmentSeeder;
use Database\Seeders\company\CompanySeeder;
use Database\Seeders\company\DepartmentTeamSeeder;
use Database\Seeders\company\RoleSeeder;
use Database\Seeders\company\SalarySeeder;
use Database\Seeders\company\TeamMemberRoleSeeder;
use Database\Seeders\company\TeamMemberSeeder;
use Database\Seeders\company\TrainingPolicySeeder;
use Database\Seeders\finance\CurrencySeeder;
use Database\Seeders\finance\InvoiceItemSeeder;
use Database\Seeders\finance\InvoiceSeeder;
use Database\Seeders\finance\PaymentTransactionSeeder;
use Database\Seeders\project\MeetingSeeder;
use Database\Seeders\project\PriorityLevelSeeder;
use Database\Seeders\project\ProjectSeeder;
use Database\Seeders\project\SprintChangeLogSeeder;
use Database\Seeders\project\SprintRetrospectiveSeeder;
use Database\Seeders\project\SprintReviewSeeder;
use Database\Seeders\project\SprintSeeder;
use Database\Seeders\project\SprintTaskSeeder;
use Database\Seeders\project\TaskSeeder;
use Database\Seeders\training\AttendanceRecordSeeder;
use Database\Seeders\training\CourseInstructorSeeder;
use Database\Seeders\training\EmployeeTrainingEnrollmentSeeder;
use Database\Seeders\training\InstructorSeeder;
use Database\Seeders\training\TrainingCourseSeeder;
use Database\Seeders\training\TrainingMaterialSeeder;
use Database\Seeders\training\TrainingSessionSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $devSeeders = [
            UserSeeder::class,
            SkillSeeder::class,
            ProficiencyLevelSeeder::class,
            UserSkillSeeder::class,
            CompanySeeder::class,
            CompanyDepartmentSeeder::class,
            DepartmentTeamSeeder::class,
            TeamMemberSeeder::class,
            RoleSeeder::class,
            TeamMemberRoleSeeder::class,
            TrainingPolicySeeder::class,
            CurrencySeeder::class,
            SalarySeeder::class,
            ProjectSeeder::class,
            PriorityLevelSeeder::class,
            TaskSeeder::class,
            MeetingSeeder::class,
            SprintSeeder::class,
            SprintTaskSeeder::class,
            SprintReviewSeeder::class,
            SprintRetrospectiveSeeder::class,
            SprintChangeLogSeeder::class,
            UserTaskSeeder::class,
            UserSprintAssignmentSeeder::class,
            CommentSeeder::class,
            InvoiceSeeder::class,
            InvoiceItemSeeder::class,
            PaymentTransactionSeeder::class,
            TrainingCourseSeeder::class,
            InstructorSeeder::class,
            CourseInstructorSeeder::class,
            TrainingSessionSeeder::class,
            EmployeeTrainingEnrollmentSeeder::class,
            TrainingMaterialSeeder::class,
            AttendanceRecordSeeder::class,
        ];

        $seeders = [
            AdminSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdminRoleSeeder::class,
        ];
        if (!app()->environment('production')) {
            $seeders = array_merge($devSeeders, $seeders);
        }

        Schema::disableForeignKeyConstraints();
        $this->call($seeders);
        Schema::enableForeignKeyConstraints();
    }
}
