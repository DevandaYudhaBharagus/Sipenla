<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $date = Carbon::now();
            $employees = Employee::all();
            foreach ($employees as $employee) {
                $test = Attendance::where('employee_id', '=', $employee->employee_id)
                        ->whereDate('date', '=', $date)
                        ->get();
                if(count($test) == 0){
                    Attendance::create([
                        "employee_id" => $employee->employee_id,
                        "check_in" => $date,
                        "check_out" => $date,
                        "date" => $date,
                        "status" => 'aab'
                    ]);
                }
            }
        })->dailyAt("17.00");

        $schedule->call(function () {
            $date = Carbon::now();
            $checks = Attendance::leftJoin('employees', 'attendances.employee_id', '=', 'employees.employee_id')
                    ->leftJoin('workshifts', 'employees.workshift_id', '=', 'workshifts.workshift_id')
                    ->where('workshifts.end_time', '<', $date)
                    ->whereNull('attendances.check_out')
                    ->get();
            foreach ($checks as $check) {
                    Attendance::where('id', $check->id)
                        ->update([
                            'check_out'     => $date,
                        ]);
                }
        })->dailyAt("17.00");
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
