<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Employee;
use App\Models\StudentAttendance;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function index()
    {

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


        return view('pages.monitoring.monitoring', compact('grade','subject', 'employee'));
    }
    public function filteringPembelajaran(Request $request)
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
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

        return view('pages.monitoring.monitoring2',compact('student','grades','subjects', 'employee'));
    }

    public function monitoringStore(Request $request)
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
        foreach($request->student_id as $key => $value){
                StudentAttendance::create([
                    'student_id' => $request->student_id[$key],
                    'status' => $request->status[$key],
                    'grade_id' => $request->grade,
                    'subject_id' => $request->mapel,
                    'teacher_id' => $employee->employee_id,
                    'date' => Carbon::now(),
                ]);
        }

        return redirect('/monitoring')->with('status', 'Monitoring Pembelajaran Terisi!');
    }
}
