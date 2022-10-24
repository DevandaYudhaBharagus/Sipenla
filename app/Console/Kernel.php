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
        })->everyMinute();
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
