<?php

namespace App\Http\Controllers\API;

use App\Models\LessonSchedule;
use App\Models\Day;
use App\Models\Grade;
use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

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
                ->get(['lesson_schedule_id', 'day_name', 'subject_name', 'start_time', 'end_time', 'first_name', 'last_name']);

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
                ->get(['lesson_schedule_id', 'day_name', 'subject_name', 'start_time', 'end_time', 'first_name', 'last_name']);

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

            return ResponseFormatter::success($response, 'Get Day Success');
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
            $teacher = LessonSchedule::join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                        ->get([
                            'teacher_id',
                            'first_name',
                            'last_name'
                        ]);

            $response = $teacher;

            return ResponseFormatter::success($response, 'Get Subject Success');
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
}
