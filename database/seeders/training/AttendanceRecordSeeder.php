<?php

namespace Database\Seeders\training;

use Database\Factories\training\AttendanceRecordFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attendance_records')->truncate();
        AttendanceRecordFactory::new()->count(10)->make()->each(function ($attendanceRecord) {
            $attendanceRecord->writeable()->save();
        });
    }
}
