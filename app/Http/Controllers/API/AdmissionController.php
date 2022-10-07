<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;

class AdmissionController extends Controller
{
    public function addEmployee(Request $request)
    {
        try{
            $user = Auth::user();
            $data = $request->all();

            $validate = Validator::make($data, [
                'first_name' => 'required',
                'last_name' => 'required',
                'nik' => 'required|unique:employees,nik|size:16',
                'nuptk' => 'required|unique:employees,nuptk|size:16',
                'npsn' => 'required|unique:employees,npsn|size:16',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'address' => 'required',
                'education' => 'required',
                'family_name' => 'required',
                'family_address' => 'required',
                'position' => 'required',
                'phone' => 'required',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            if ($request->file('profile_employee')) {
                $test['profile_employee'] = $request->file('profile_employee')->store('profile-employee');
            }

            $employeeData = Employee::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'nik' => $data['nik'],
                'nuptk' => $data['nuptk'],
                'npsn' => $data['npsn'],
                'place_of_birth' => $data['place_of_birth'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'religion' => $data['religion'],
                'address' => $data['address'],
                'education' => $data['education'],
                'family_name' => $data['family_name'],
                'family_address' => $data['family_address'],
                'position' => $data['position'],
                'phone' => $data['phone'],
                "image" => $test['profile_employee'],
            ]);

            $leaveBalance = LeaveBalance::create([
                'employee_id' => $employeeData['employee_id'],
                'total_balance' => 12
            ]);

            return ResponseFormatter::success( "Succeed added Employee Data.");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function addStudent(Request $request)
    {
        try{
            $user = Auth::user();
            $data = $request->all();
            // dd($data);

            $validate = Validator::make($data, [
                'first_name' => 'required',
                'last_name' => 'required',
                'nik' => 'required|unique:employees,nik|size:16',
                'nisn' => 'required|unique:employees,nik|size:16',
                'father_name' => 'required',
                'mother_name' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'address' => 'required',
                'family_name' => 'required',
                'family_address' => 'required',
                'phone' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'school_origin' => 'required',
                'school_now' => 'required',
                'parent_address' => 'required',
                'mother_profession' => 'required',
                'father_profession' => 'required',
                'mother_education' => 'required',
                'father_education' => 'required',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }


            if ($request->file('profile_student')) {
                $test['profile_student'] = $request->file('profile_student')->store('profile-student');
            }

            $studentData = Student::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'nik' => $data['nik'],
                'nisn' => $data['nisn'],
                'mother_name' => $data['mother_name'],
                'place_of_birth' => $data['place_of_birth'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'religion' => $data['religion'],
                'address' => $data['address'],
                'father_name' => $data['father_name'],
                'family_name' => $data['family_name'],
                'family_address' => $data['family_address'],
                'school_origin' => $data['school_origin'],
                'school_now' => $data['school_now'],
                'parent_address' => $data['parent_address'],
                'mother_profession' => $data['mother_profession'],
                'father_profession' => $data['father_profession'],
                'mother_education' => $data['mother_education'],
                'father_education' => $data['father_education'],
                'phone' => $data['phone'],
                'image' => $test['profile_student'],
            ]);

            return ResponseFormatter::success( "Succeed added Student Data.");
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
