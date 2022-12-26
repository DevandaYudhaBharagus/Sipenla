<?php

namespace App\Http\Controllers;
use App\Models\Workday;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(){
        return view('pages.jadwal.jadwal');
    }
    public function jadwalkerja(){

        $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $scheduleSenin = Workday::join('workshifts', 'workdays.workshift_id', '=', 'workshifts.workshift_id')
                        ->join('days', 'workdays.days_id', '=', 'days.day_id')
                        ->join('employees', 'workshifts.workshift_id', '=', 'employees.workshift_id')
                        ->where('days.day_name','=','Senin')
                        ->where('employees.employee_id', '=', $employee->employee_id)
                        ->first([
                            'day_name',
                            'employees.first_name',
                            'employees.last_name',
                            'workshifts.start_time',
                            'workshifts.end_time',
                        ]);
          
            $scheduleSelasa = Workday::join('workshifts', 'workdays.workshift_id', '=', 'workshifts.workshift_id')
                        ->join('days', 'workdays.days_id', '=', 'days.day_id')
                        ->join('employees', 'workshifts.workshift_id', '=', 'employees.workshift_id')
                        ->where('days.day_name','=','Selasa')
                        ->where('employees.employee_id', '=', $employee->employee_id)
                        ->first([
                            'day_name',
                            'employees.first_name',
                            'employees.last_name',
                            'workshifts.start_time',
                            'workshifts.end_time',
                        ]);
            $scheduleRabu = Workday::join('workshifts', 'workdays.workshift_id', '=', 'workshifts.workshift_id')
                        ->join('days', 'workdays.days_id', '=', 'days.day_id')
                        ->join('employees', 'workshifts.workshift_id', '=', 'employees.workshift_id')
                        ->where('days.day_name','=','Rabu')
                        ->where('employees.employee_id', '=', $employee->employee_id)
                        ->first([
                            'day_name',
                            'employees.first_name',
                            'employees.last_name',
                            'workshifts.start_time',
                            'workshifts.end_time',
                        ]);
            $scheduleKamis = Workday::join('workshifts', 'workdays.workshift_id', '=', 'workshifts.workshift_id')
                        ->join('days', 'workdays.days_id', '=', 'days.day_id')
                        ->join('employees', 'workshifts.workshift_id', '=', 'employees.workshift_id')
                        ->where('days.day_name','=','Kamis')
                        ->where('employees.employee_id', '=', $employee->employee_id)
                        ->first([
                            'day_name',
                            'employees.first_name',
                            'employees.last_name',
                            'workshifts.start_time',
                            'workshifts.end_time',
                        ]);
            $scheduleJumat = Workday::join('workshifts', 'workdays.workshift_id', '=', 'workshifts.workshift_id')
                        ->join('days', 'workdays.days_id', '=', 'days.day_id')
                        ->join('employees', 'workshifts.workshift_id', '=', 'employees.workshift_id')
                        ->where('days.day_name','=','Jumat')
                        ->where('employees.employee_id', '=', $employee->employee_id)
                        ->first([
                            'day_name',
                            'employees.first_name',
                            'employees.last_name',
                            'workshifts.start_time',
                            'workshifts.end_time',
                        ]);


        return view('pages.jadwal.jadwal-shift-kerja', compact('scheduleSenin','scheduleSelasa','scheduleRabu','scheduleKamis','scheduleJumat') );
    }
}
