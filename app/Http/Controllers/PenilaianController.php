<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Employee;
use App\Models\Semester;
use App\Models\Assessment;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use App\Models\AcademicYears;
use App\Models\LessonSchedule;
use Illuminate\Support\Facades\Auth;


class PenilaianController extends Controller
{
    public function getFilteringPenilaian(){

        //Noteeeeee
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
        $grade =  LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
        ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)->get([
            'grades.grade_id',
            'grade_name',
            'start_time',
            'end_time',
            'subject_name',
            'subjects.subject_id'
        ]);

        // $subject = LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
        // ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
        // ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)->get([
        //     'grades.grade_id',
        //     'grade_name',
        //     'start_time',
        //     'end_time',
        //     'subject_name'
        // ]);
        $semester = Semester::get();
        $academic = AcademicYears::get();
        $assessment = Assessment::get();
        
       

        return view('pages.penilaian.penilaian-blank', compact('semester','academic','assessment','grade'));
    }

    public function PenilaianSiswa(Request $request){
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
        $semesters = Semester::where('semester_id', '=', $request->semester)->first();
        $academics = AcademicYears::where('academic_year_id', '=', $request->tahun)->first();
        $assessments = Assessment::where('assessment_id', '=', $request->penilaian)->first();

        return view('pages.penilaian.penilaian', compact('student','grades','subjects','semesters','academics','assessments'));


    }
}
