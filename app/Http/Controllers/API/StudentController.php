<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use App\Models\Employee;
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
}
