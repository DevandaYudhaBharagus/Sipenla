<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataUserController extends Controller
{
    public function getDataStudent()
    {
        $student = Student::join('users', 'students.user_id', '=', 'users.id')
        ->join('student_grades', 'students.student_id', '=', 'student_grades.student_id')
        ->join('grades', 'student_grades.grade_id', '=', 'grades.grade_id')
        ->get();

        return view('pages.tabel-data.tabel-siswa-admin' , compact('student'));
    }
    public function getDataEmployee()
    {
        $employee = Employee::join('users', 'employees.user_id', '=', 'users.id')
        ->get();

        return view('pages.tabel-data.tabel-pegawai-admin', compact('employee') );
    }
}
