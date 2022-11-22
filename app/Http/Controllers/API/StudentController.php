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
}
