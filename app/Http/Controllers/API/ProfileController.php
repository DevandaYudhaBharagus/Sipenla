<?php

namespace App\Http\Controllers\API;

use App\Helpers\DateHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Student;
use App\Models\Guardian;
use Exception;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile()
    {
        try {
            $user = Auth::user();
            if($user->role == "student"){
                $student = Student::where('user_id', '=', $user->id)->first();
                $date = ($student->date_of_birth !== null) ? date('d F Y', strtotime($student->date_of_birth)) : '';
                $student->date_of_birth = $date;
                $response = [
                    $student,
                ];

                return ResponseFormatter::success($response, 'Get User');
            }else if($user->role == "walimurid"){
                $guardian = Guardian::where('user_id', '=', $user->id)->first();
                $date = ($guardian->date_of_birth !== null) ? date('d F Y', strtotime($guardian->date_of_birth)) : '';
                $guardian->date_of_birth = $date;
                $response = [
                    $guardian,
                ];

                return ResponseFormatter::success($response, 'Get User');
            }else{
                $employee = Employee::where('user_id', '=', $user->id)->first();
                $date = ($employee->date_of_birth !== null) ? date('d F Y', strtotime($employee->date_of_birth)) : '';
                $employee->date_of_birth = $date;
                $response = [
                    $employee,
                ];

                return ResponseFormatter::success($response, 'Get User');
            }
        }
        catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
