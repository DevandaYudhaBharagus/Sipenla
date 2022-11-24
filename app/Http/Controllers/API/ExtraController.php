<?php

namespace App\Http\Controllers\API;

use App\Models\ExtraSchedule;
use App\Models\Extracurricular;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class ExtraController extends Controller
{
    public function getScheduleExtra($extra)
    {
        try{
            $schedule = ExtraSchedule::join('days', 'extra_schedules.days_id', '=', 'days.day_id')
                ->join('extracurriculars', 'extra_schedules.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                ->join('employees', 'extra_schedules.teacher_id', '=', 'employees.employee_id')
                ->where('extra_schedules.extracurricular_id', '=', $extra)
                ->get([
                    'extra_schedules_id',
                    'day_name',
                    'extracurricular_name',
                    'start_time',
                    'end_time',
                    'first_name',
                    'last_name',
                    'extra_schedules.days_id',
                    'extra_schedules.extracurricular_id',
                    'extra_schedules.teacher_id'
                ]);

            $response = $schedule;

            return ResponseFormatter::success($response, 'Get Schedule Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getByDayExtra($extra, $day)
    {
        try{
            $schedule = ExtraSchedule::join('days', 'extra_schedules.days_id', '=', 'days.day_id')
                ->join('extracurriculars', 'extra_schedules.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                ->join('employees', 'extra_schedules.teacher_id', '=', 'employees.employee_id')
                ->where('extra_schedules.extracurricular_id', '=', $extra)
                ->where('extra_schedules.days_id', '=', $day)
                ->get([
                    'extra_schedules_id',
                    'day_name',
                    'extracurricular_name',
                    'start_time',
                    'end_time',
                    'first_name',
                    'last_name',
                    'extra_schedules.days_id',
                    'extra_schedules.extracurricular_id',
                    'extra_schedules.teacher_id'
                ]);

            $response = $schedule;

            return ResponseFormatter::success($response, 'Get Schedule Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getExtra()
    {
        try{
            $grade = Extracurricular::get(['extracurricular_id', 'extracurricular_name']);

            $response = $grade;

            return ResponseFormatter::success($response, 'Get Grade Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateExtra(Request $request, $id)
    {
        try{
            $edit = [
                "days_id" => $request->days_id,
                "extracurricular_id" => $request->extracurricular_id,
                "teacher_id" => $request->teacher_id,
                "start_time" => $request->start_time,
                "end_time" => $request->end_time
            ];

            $updateSchedule = ExtraSchedule::where('extra_schedules_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Schedule Has Been Updated');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getPembina()
    {
        try{
            $teacher = Employee::join('users', 'employees.user_id', '=', 'users.id')
                        ->where('role', '=', 'pembinaextra')
                        ->get([
                            'employee_id',
                            'first_name',
                            'last_name'
                        ]);

            $response = $teacher;

            return ResponseFormatter::success($response, 'Get Teacher Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
