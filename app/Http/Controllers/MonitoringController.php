<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Employee;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function index(){

        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
        $grade =  LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
        ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
        ->first([
            'grades.grade_id',
            'grade_name',
            'start_time',
            'end_time',
            'subject_name',
            'subjects.subject_id'
        ]);

        $subject = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
        ->get([
            'subjects.subject_id',
            'subject_name'
        ]);

   
        return view('pages.monitoring.monitoring', compact('grade','subject'));
    }
    public function filteringPembelajaran(Request $request){
        $student = StudentGrade::join('students', 'student_grades.student_id', '=', 'students.student_id')
        ->where('student_grades.grade_id', '=', $request->grade)
        ->get([
            'students.student_id',
            'first_name',
            'last_name',
            'nisn'
        ]);
        $grades = Grade::where('grade_id', '=', $request->grade)->first();
        $subjects = Subject::where('subject_id', '=', $request->mapel)->first();
   
        return view('pages.monitoring.monitoring2',compact('student','grades','subjects'));
    }


}
