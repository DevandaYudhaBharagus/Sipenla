<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Employee;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'student') {
            $student = Student::join('users', 'students.user_id', '=', 'users.id')
            ->join('student_grades', 'students.student_id', '=', 'student_grades.student_id')
            ->join('grades', 'student_grades.grade_id', '=', 'grades.grade_id')
            ->Join('employees', 'grades.teacher_id', '=', 'employees.employee_id')
            ->join('extracurriculars', 'students.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
            ->where('students.user_id', '=', $user->id)->first([
                'students.student_id',
                'students.nisn',
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
                'extracurriculars.extracurricular_name',
                'users.email'
            ]);
            $murid = [];
            if(!$student){
                $murid = Student::with('extracurricular')->where('user_id', $user->id)->first();
            }
            return view('pages.dashboard.profil.profil-student', compact('student', 'murid'));
        }elseif($user->role == 'walimurid'){
            $guardian = Guardian::where('student_guardians.user_id', '=', $user->id)
            ->join('students', 'student_guardians.student_id', '=', 'students.student_id')
            ->first();

            return view('pages.dashboard.profil.profil-walimurid', compact('guardian'));
        }
        // return view('pages.dashboard.profil');
       else{
        $employee = Employee::where('user_id', '=', $user->id)
        ->join('users', 'employees.user_id', '=', 'users.id')
        ->first();
        return view('pages.dashboard.profil.profil-employee', compact('employee'));
       }
    }
}
