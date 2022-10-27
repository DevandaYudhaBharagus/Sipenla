<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            EmployeeSeeder::class,
            NewsSeeder::class,
            LeaveTypeSeeder::class,
            StatusCodeSeeder::class,
            DaySeeder::class,
            CompanySeeder::class,
            WorkdaySeeder::class,
            WorkshiftSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
