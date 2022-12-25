<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\OfficialDuty;
use Illuminate\Http\Request;
use App\Models\LeaveApplication;
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

    public function getFolmulirsiswa($id){
        $student = Student::where('user_id', '=', $id)
        ->join('users', 'user_id', '=', 'users.id')
        ->join('extracurriculars', 'students.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
        ->first();
            $date = ($student->date_of_birth !== null) ? date('d F Y', strtotime($student->date_of_birth)) : '';
            $student->date_of_birth = $date;

        
        return view('pages.tabel-data.data-form-siswa', compact('student'));    
    }
    public function getFolmulirpegawai($id){
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $id)
                    ->join('users', 'user_id', '=', 'users.id')
                    // ->join('workshifts','employees.workshift_id','=','workshifts.workshift_id')
                    ->first();
        $date = ($employee->date_of_birth !== null) ? date('d F Y', strtotime($employee->date_of_birth)) : '';
        $employee->date_of_birth = $date;

        
            return view('pages.tabel-data.data-form-pegawai', compact('employee')); 
    }
    public function getAbsensiPegawai($id){
        $employee = Employee::where('user_id', '=', $id)->first();
//Hadir
        $hadir = Attendance::where('employee_id', '=', $employee->employee_id)
                    ->where('status', '=', 'ac')
                    ->count();
//alpa
        $alpha = Attendance::where('employee_id', '=', $employee->employee_id)
                    ->where('status', '=', 'aab')
                    ->count();
//izin
        $izin = LeaveApplication::where('employee_id', '=', $employee->employee_id)
                    ->count();

        $duty = OfficialDuty::where('employee_id', '=', $employee->employee_id)
                    ->count();

        $listAbsen = Attendance::where('employee_id', '=', $employee->employee_id)
                    ->get();
 
            return view('pages.tabel-data.absensi-pegawai',compact('hadir','alpha','izin','employee','listAbsen')); 
    }
}
