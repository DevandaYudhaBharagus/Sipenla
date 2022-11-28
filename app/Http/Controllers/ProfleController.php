<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'student') {
            $student = Student::join('student_grades', 'students.student_id', '=', 'student_grades.student_id')
            ->join('grades', 'student_grades.grade_id', '=', 'grades.grade_id')
            ->Join('employees', 'grades.teacher_id', '=', 'employees.employee_id')
            ->join('extracurriculars', 'students.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
            ->where('students.user_id', '=', $user->id)->first([
                'students.student_id',
                'students.nisn',
                'students.nik',
                'students.father_name',
                'students.mother_name',
                'students.gender',
                'students.phone',
                'students.place_of_birth',
                'students.date_of_birth',
                'students.address',
                'students.religion',
                'students.image',
                'students.first_name as student_first_name',
                'students.last_name as student_last_name',
                'employees.first_name as employee_first_name',
                'employees.last_name as     ',
                'grades.grade_id',
                'grades.grade_name',
                'extracurriculars.extracurricular_id',
                'extracurriculars.extracurricular_name'
            ]);
            return view('pages.dashboard.profil.profil-student', compact('student'));
        }elseif($user->role == 'walimurid'){
            
        }
        // return view('pages.dashboard.profil');
       else{
        $employee = Employee::where('user_id', '=', $user->id)->first();
        return view('pages.dashboard.profil.profil-employee', compact('employee'));
       }
    }
}
