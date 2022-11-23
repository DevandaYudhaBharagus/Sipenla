<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\OfficialDuty;
use App\Models\Rapor;
use App\Models\Attendance;
use App\Models\PenilaianExtra;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function getDataStudent()
    {
        try{
            $student = Student::join('users', 'students.user_id', '=', 'users.id')
                        ->get([
                            "students.student_id",
                            "first_name",
                            "last_name",
                            "nisn",
                            "email",
                            "role",
                        ]);

            $response = $student;

            return ResponseFormatter::success($response, 'Get Student Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getDataEmployee()
    {
        try{
            $employee = Employee::join('users', 'employees.user_id', '=', 'users.id')
                    ->get([
                        "employees.employee_id",
                        "first_name",
                        "last_name",
                        "nuptk",
                        "email",
                        "role",
                    ]);
            $response = $employee;

            return ResponseFormatter::success($response, 'Get Student Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getDataStudentByName($student)
    {
        try{
            $students = Student::join('users', 'students.user_id', '=', 'users.id')
                    ->where('first_name', 'like', "%$student%")
                    ->orWhere('last_name', 'like', "%$student%")
                    ->orWhere('nisn', 'like', "%$student%")
                    ->get([
                        "students.student_id",
                        "first_name",
                        "last_name",
                        "nisn",
                        "email",
                        "role",
                    ]);
            $response = $students;

            return ResponseFormatter::success($response, 'Get Student Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getDataEmployeeByName($employee)
    {
        try{
            $employees = Employee::join('users', 'employees.user_id', '=', 'users.id')
                    ->where('first_name', 'like', "%$employee%")
                    ->orWhere('last_name', 'like', "%$employee%")
                    ->orWhere('nuptk', 'like', "%$employee%")
                    ->get([
                        "employees.employee_id",
                        "first_name",
                        "last_name",
                        "nuptk",
                        "email",
                        "role",
                    ]);
            $response = $employees;

            return ResponseFormatter::success($response, 'Get Employee Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyAttendance($employee)
    {
        try{
            $attendance = Attendance::where('employee_id', '=', $employee)
                        ->orderBy('created_at', 'asc')
                        ->get();

            $week = [];

            foreach ($attendance as $att) {
                $x = Carbon::parse($att->date)->format('W');
                array_push($week, (object)["week"=>$x, "slider"=>1]);
            }

            $unique = collect($week)->unique('week')->values()->all();

            $response = $unique;

            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyAll($employee)
    {
        try{
            $attendance = Attendance::where('employee_id', '=', $employee)
                        ->get();

            foreach ($attendance as $att) {
                $time = $att->date;
                $test2 = ($att->created_at !== null) ? date('d F Y', strtotime($time)) : '';
                $att->date = $test2;
            }

            $response =  $attendance;
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function statistic($employee)
    {
        try{

            $attend = Attendance::where('employee_id', '=', $employee)
                        ->where('status', '=', 'ace')
                        ->count();

            $absence = Attendance::where('employee_id', '=', $employee)
                        ->where('status', '=', 'aab')
                        ->count();

            $leave = LeaveApplication::where('employee_id', '=', $employee)
                        ->count();

            $duty = OfficialDuty::where('employee_id', '=', $employee)
                        ->count();

            $days_work = 480;
            $days_presence_percentages = ($attend / $days_work) * 100;
            $days_absent_percentages = ($absence / $days_work) * 100;
            $days_leave_percentages = ($leave / $days_work) * 100;
            $days_duty_percentages = ($duty / $days_work) * 100;

            $fixAttend = round($days_presence_percentages, 0);
            $fixAbsence = round($days_absent_percentages, 0);
            $fixLeave = round($days_leave_percentages, 0);
            $fixDuty = round($days_duty_percentages, 0);

            $response = [
                "attend" => "$fixAttend",
                "absence" => "$fixAbsence",
                "leave" => "$fixLeave",
                "duty" => "$fixDuty"
            ];
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getEmployee($employee)
    {
        try{
            $employee = Employee::where('employee_id', '=', $employee)->first();
            if(!$employee){
                return ResponseFormatter::error('Not Found', 404);
            }
            $date = ($employee->date_of_birth !== null) ? date('d F Y', strtotime($employee->date_of_birth)) : '';
            $employee->date_of_birth = $date;
            $response = [
                'employee_id' => $employee->employee_id,
                'user_id' => $employee->user_id,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'nik' => $employee->nik,
                'nuptk' => $employee->nuptk,
                'npsn' => $employee->npsn,
                'place_of_birth' => $employee->place_of_birth,
                'date_of_birth' => $employee->date_of_birth,
                'gender' => $employee->gender,
                'address' => $employee->address,
                'phone' => $employee->phone,
                'education' => $employee->education,
                'religion' => $employee->religion,
                'family_address' => $employee->family_address,
                'family_name' => $employee->family_name,
                'position' => $employee->position,
                'image' => $employee->image
            ];

            return ResponseFormatter::success($response, 'Get Employee');
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function historySubjectAll($student)
    {
        try{
            $attendance = StudentAttendance::join('subjects', 'student_attendances.subject_id', '=', 'subjects.subject_id')
                        ->where('student_id', '=', $student)
                        ->get([
                            'student_attendance_id',
                            'student_attendances.grade_id',
                            'student_attendances.student_id',
                            'student_attendances.subject_id',
                            'student_attendances.teacher_id',
                            'student_attendances.date',
                            'student_attendances.status',
                            'student_attendances.created_at',
                            'student_attendances.updated_at',
                            'subjects.subject_name',
                        ]);

            foreach ($attendance as $att) {
                $time = $att->created_at;
                $test2 = Carbon::parse($time)->format('H:i:s');
                $att->waktu = $test2;
            }

            $response =  $attendance;
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyAttendanceMapelByWeek($student)
    {
        try{
            $attendance = StudentAttendance::where('student_id', '=', $student)
                        ->orderBy('created_at', 'asc')
                        ->get();

            $week = [];

            foreach ($attendance as $att) {
                $x = Carbon::parse($att->date)->format('W');
                array_push($week, (object)["week"=>$x, "slider"=>1]);
            }

            $unique = collect($week)->unique('week')->values()->all();

            $response = $unique;

            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function statisticMapel($student)
    {
        try{

            $attend = StudentAttendance::where('student_id', '=', $student)
                        ->where('status', '=', 'mas')
                        ->count();

            $absence = StudentAttendance::where('student_id', '=', $student)
                        ->where('status', '=', 'mes')
                        ->count();

            $sick = StudentAttendance::where('student_id', '=', $student)
                        ->where('status', '=', 'mss')
                        ->count();

            $izin = StudentAttendance::where('student_id', '=', $student)
                        ->where('status', '=', 'mls')
                        ->count();

            $days_work = 120;
            $days_presence_percentages = ($attend / $days_work) * 100;
            $days_absent_percentages = ($absence / $days_work) * 100;
            $days_leave_percentages = ($sick / $days_work) * 100;
            $days_duty_percentages = ($izin / $days_work) * 100;

            $fixAttend = round($days_presence_percentages, 0);
            $fixAbsence = round($days_absent_percentages, 0);
            $fixLeave = round($days_leave_percentages, 0);
            $fixDuty = round($days_duty_percentages, 0);

            $response = [
                "attend" => "$fixAttend",
                "absence" => "$fixAbsence",
                "sick" => "$fixLeave",
                "izin" => "$fixDuty"
            ];
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getStudent($student)
    {
        try{
            $student = Student::where('student_id', '=', $student)->first();
            if(!$student){
                return ResponseFormatter::error('Not Found', 404);
            }
            $date = ($student->date_of_birth !== null) ? date('d F Y', strtotime($student->date_of_birth)) : '';
            $dateSchool = ($student->date_school_now !== null) ? date('d F Y', strtotime($student->date_school_now)) : '';
            $student->date_of_birth = $date;
            $student->date_school_now = $dateSchool;
            $response = [
                'student_id' => $student->student_id,
                'user_id' => $student->user_id,
                'nisn' => $student->nisn,
                'nik' => $student->nik,
                'first_name' => $student->first_name,
                'last_name' => $student->last_name,
                'mother_name' => $student->mother_name,
                'father_name' => $student->father_name,
                'gender' => $student->gender,
                'phone' => $student->phone,
                'place_of_birth' => $student->place_of_birth,
                'date_of_birth' => $student->date_of_birth,
                'date_school_now' => $student->date_school_now,
                'address' => $student->address,
                'religion' => $student->religion,
                'school_origin' => $student->school_origin,
                'school_now' => $student->school_now,
                'parent_address' => $student->parent_address,
                'mother_profession' => $student->mother_profession,
                'father_profession' => $student->father_profession,
                'father_education' => $student->father_education,
                'mother_education' => $student->mother_education,
                'family_name' => $student->family_name,
                'family_address' => $student->family_address,
                'family_profession' => $student->family_profession,
                'image' => $student->image
            ];

            return ResponseFormatter::success($response, 'Get Student');
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getRapor($student)
    {
        try{
            $rapor = Rapor::join('subjects', 'rapors.subject_id', 'subjects.subject_id')
                    ->where('student_id', '=', $student)
                    ->where('rapors.status', '=', 'rkk')
                    ->whereDate('rapors.created_at','>', Carbon::now()->subYear())
                    ->get([
                        "subject_name",
                        "nilai_fix"
                    ]);

            $extra = PenilaianExtra::join('extracurriculars', 'penilaian_extras.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                    ->where('student_id', '=', $student)
                    ->get([
                        "extracurricular_name",
                        "nilai",
                    ]);

            $student = Student::join('student_grades', 'students.student_id', '=', 'student_grades.student_id')
                        ->join('grades', 'student_grades.grade_id', '=', 'grades.grade_id')
                        ->join('rapors', 'students.student_id', '=', 'rapors.student_id')
                        ->join('semesters', 'rapors.semester_id', '=', 'semesters.semester_id')
                        ->join('academic_years', 'rapors.academic_year_id', '=', 'academic_years.academic_year_id')
                        ->where('students.student_id', '=', $student)
                        ->first([
                            "first_name",
                            "last_name",
                            "nisn",
                            "grade_name",
                            "semester_name",
                            "academic_year"
                        ]);

            if(is_null($rapor)){
                $response = [
                    "status" => "-",
                    "nilai" => [],
                    "extra" => []
                ];

                return ResponseFormatter::success($response, 'Get Rapor Success');
            }

            foreach($rapor as $r){
                if($r->nilai_fix < 75){
                    $response = [
                        "status" => "Tidak",
                        "nilai" => $rapor,
                        "extra" => $extra
                    ];

                    return ResponseFormatter::success($response, 'Get Rapor Success');
                }
            }

            $response = [
                    "first_name" => $student->first_name,
                    "last_name" => $student->last_name,
                    "nisn" => $student->nisn,
                    "grade_name" => $student->grade_name,
                    "semester_name" => $student->semester_name,
                    "academic_year" => $student->academic_year,
                    "status" => "naik",
                    "nilai" => $rapor,
                    "extra" => $extra
                ];

            return ResponseFormatter::success($response, 'Get Rapor Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
