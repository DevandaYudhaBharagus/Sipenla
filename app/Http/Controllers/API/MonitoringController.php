<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Grade;
use App\Models\StudentGrade;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonSchedule;
use App\Models\StudentAttendance;

class MonitoringController extends Controller
{
    public function getSubject()
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $schedule = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                        ->where('teacher_id', '=', $employee->employee_id)
                ->get([
                    'subjects.subject_id',
                    'subjects.subject_name'
                ]);

            $response = $schedule;

            return ResponseFormatter::success($response, 'Get Subject Success');
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
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $schedule = LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                ->get([
                    'grades.grade_id',
                    'grades.grade_name'
                ]);

            $response = $schedule;

            return ResponseFormatter::success($response, 'Get Subject Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAttendance($grade)
    {
        try{
            $attendances = StudentGrade::join('students', 'student_grades.student_id', '=', 'students.student_id')
                        ->where('student_grades.grade_id', '=', $grade)
                        ->get([
                            'students.student_id',
                            'first_name',
                            'last_name',
                            'nisn'
                        ]);

            $fix = [];

            foreach ($attendances as $attendance) {
                array_push($fix, (object)["absensi"=>$attendance, "status"=>"default"]);
            }

            $response = $fix;

            return ResponseFormatter::success($response, 'Get Subject Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function addMultiple(Request $request){
        if($request->isMethod('post')){
            $bookData = $request->all();

            foreach($bookData['books'] as $key => $value){
                $book = new StudentAttendance;
                $book->grade_id = $value['grade_id'];
                $book->student_id = $value['student_id'];
                $book->subject_id = $value['subject_id'];
                $book->save();
            }
            return response()->json(['message'=>'Books added Successfully']);
        }
    }
}
