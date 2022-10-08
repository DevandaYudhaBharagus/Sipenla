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
                if(!$student){
                    $response = [
                        'nisn' => "-",
                        'nik' => "-",
                        'first_name' => "-",
                        'last_name' => "-",
                        'father_name' => "-",
                        'mother_name' => "-",
                        'gender' => "-",
                        'phone' => "-",
                        'place_of_birth' => "-",
                        'date_of_birth' => "-",
                        'address' => "-",
                        'religion' => "-",
                        'image' => null,
                        'status' => 'false'
                    ];

                    return ResponseFormatter::success($response, 'Get User');
                }
                $date = ($student->date_of_birth !== null) ? date('d F Y', strtotime($student->date_of_birth)) : '';
                $student->date_of_birth = $date;
                $response = [
                    'nisn' => $student->nisn,
                    'nik' => $student->nik,
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    'father_name' => $student->father_name,
                    'mother_name' => $student->mother_name,
                    'gender' => $student->gender,
                    'phone' => $student->phone,
                    'place_of_birth' => $student->place_of_birth,
                    'date_of_birth' => $student->date_of_birth,
                    'address' => $student->address,
                    'religion' => $student->religion,
                    'image' => $student->image,
                    'status' => 'true'
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
                if(!$employee){
                    $response = [
                        'nuptk' => "-",
                        'first_name' => "-",
                        'last_name' => "-",
                        'nik' => "-",
                        'npsn' => "-",
                        'place_of_birth' => "-",
                        'date_of_birth' => "-",
                        'gender' => "-",
                        'religion' => "-",
                        'address' => "-",
                        'education' => "-",
                        'family_name' => "-",
                        'family_address' => "-",
                        'position' => "-",
                        'image' => null,
                        'status' => 'false'
                    ];

                    return ResponseFormatter::success($response, 'Get User');
                }
                $date = ($employee->date_of_birth !== null) ? date('d F Y', strtotime($employee->date_of_birth)) : '';
                $employee->date_of_birth = $date;
                $response = [
                    'nuptk' => $employee->nuptk,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'nik' => $employee->nik,
                    'npsn' => $employee->npsn,
                    'place_of_birth' => $employee->place_of_birth,
                    'date_of_birth' => $employee->date_of_birth,
                    'gender' => $employee->gender,
                    'religion' => $employee->religion,
                    'address' => $employee->address,
                    'education' => $employee->education,
                    'family_name' => $employee->family_name,
                    'family_address' => $employee->family_address,
                    'position' => $employee->position,
                    'image' => $employee->image,
                    'status' => 'true'
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

    public function getDataStudent()
    {
        try{
            $student = Student::get(['student_id', 'first_name', 'last_name']);
            $response = [
                $student
            ];

            return ResponseFormatter::success($response, 'Get Student');

        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
