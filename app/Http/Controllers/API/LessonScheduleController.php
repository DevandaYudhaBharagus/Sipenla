<?php

namespace App\Http\Controllers\API;

use App\Models\LessonSchedule;
use App\Models\Day;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Employee;
use App\Models\Workday;
use App\Models\Workshift;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;

class LessonScheduleController extends Controller
{
    public function getSchedule($grade)
    {
        try{
            $schedule = LessonSchedule::join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                ->join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                ->join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                ->where('lesson_schedules.grade_id', '=', $grade)
                ->get([
                    'lesson_schedule_id',
                    'day_name',
                    'subject_name',
                    'start_time',
                    'end_time',
                    'first_name',
                    'last_name',
                    'lesson_schedules.days_id',
                    'lesson_schedules.subject_id',
                    'lesson_schedules.teacher_id'
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

    public function getDay()
    {
        try{
            $day = Day::get(['day_id', 'day_name']);

            $response = $day;

            return ResponseFormatter::success($response, 'Get Day Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getByDay($grade, $day)
    {
        try{
            $schedule = LessonSchedule::join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                ->join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                ->join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                ->where('lesson_schedules.grade_id', '=', $grade)
                ->where('lesson_schedules.days_id', '=', $day)
                ->get([
                    'lesson_schedule_id',
                    'day_name',
                    'subject_name',
                    'start_time',
                    'end_time',
                    'first_name',
                    'last_name',
                    'lesson_schedules.days_id',
                    'lesson_schedules.subject_id',
                    'lesson_schedules.teacher_id'
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

    public function getGrade()
    {
        try{
            $grade = Grade::get(['grade_id', 'grade_name']);

            $response = $grade;

            return ResponseFormatter::success($response, 'Get Grade Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getSubject()
    {
        try{
            $subject = Subject::get(['subject_id', 'subject_name']);

            $response = $subject;

            return ResponseFormatter::success($response, 'Get Subject Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getTeacher()
    {
        try{
            $teacher = Employee::join('users', 'employees.user_id', '=', 'users.id')
                        ->where('role', '=', 'guru')
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

    public function editSchedule(Request $request, $id)
    {
        try{
            $edit = [
                "days_id" => $request->days_id,
                "subject_id" => $request->subject_id,
                "teacher_id" => $request->teacher_id,
                "start_time" => $request->start_time,
                "end_time" => $request->end_time
            ];

            $updateSchedule = LessonSchedule::where('lesson_schedule_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Schedule Has Been Updated');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getScheduleByTeacher()
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $schedule = LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                        ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                        ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)->get([
                            'day_name',
                            'grade_name',
                            'start_time',
                            'end_time',
                            'subject_name'
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

    public function getScheduleByDay($day)
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $schedule = LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                        ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                        ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                        ->where('lesson_schedules.days_id', '=', $day)
                        ->get([
                            'day_name',
                            'grade_name',
                            'start_time',
                            'end_time',
                            'subject_name'
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

    public function getScheduleBySubject($subject)
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $schedule = LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                        ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                        ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                        ->where('lesson_schedules.subject_id', '=', $subject)
                        ->get([
                            'day_name',
                            'grade_name',
                            'start_time',
                            'end_time',
                            'subject_name'
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

    public function getWork()
    {
        try{
            $workday = Workday::join('workshifts', 'workdays.workshift_id', '=', 'workshifts.workshift_id')
                    ->join('days', 'workdays.days_id', '=', 'days.day_id')
                    ->join('employees', 'workshifts.workshift_id', '=', 'employees.workshift_id')
                    ->get([
                        'day_name',
                        'shift_name',
                        'start_time',
                        'end_time',
                        'workdays.workshift_id',
                        'workdays.days_id',
                        'employees.employee_id',
                        'employees.first_name',
                        'employees.last_name'
                    ]);

            $response = $workday;

            return ResponseFormatter::success($response, 'Get Schedule Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getWorkday($day)
    {
        try{
            $workday = Workday::join('workshifts', 'workdays.workshift_id', '=', 'workshifts.workshift_id')
                    ->join('days', 'workdays.days_id', '=', 'days.day_id')
                    ->join('employees', 'workshifts.workshift_id', '=', 'employees.workshift_id')
                    ->where('days_id', '=', $day)
                    ->get([
                        'day_name',
                        'shift_name',
                        'start_time',
                        'end_time',
                        'workdays.workshift_id',
                        'workdays.days_id',
                        'employees.employee_id',
                        'employees.first_name',
                        'employees.last_name'
                    ]);

            $response = $workday;

            return ResponseFormatter::success($response, 'Get Schedule Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function editWorkday(Request $request, $id)
    {
        try{
            $edit = [
                "days_id" => $request->days_id,
            ];

            $editEmployee = [
                "workshift_id" => $request->workshift_id,
            ];

            $updateSchedule = Workday::where('workdays_id', '=', $id)
                            ->update($edit);

            $updateEmployee = Employee::where('employee_id', '=', $request->employee_id)
                            ->update($editEmployee);

            return ResponseFormatter::success('Schedule Has Been Updated');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getEmployee()
    {
        try{
            $employee = Employee::get([
                            'employee_id',
                            'first_name',
                            'last_name'
                        ]);

            $response = $employee;

            return ResponseFormatter::success($response, 'Get Employee Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getShift()
    {
        try{
            $shift = Workshift::get([
                'workshift_id',
                'shift_name'
            ]);

            $response = $shift;

            return ResponseFormatter::success($response, 'Get Shift Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
