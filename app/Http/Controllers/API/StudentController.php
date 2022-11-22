<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\OfficialDuty;
use App\Models\Attendance;
use Illuminate\Http\Request;
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
                        ->where('status', '=', 'ac')
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
}
