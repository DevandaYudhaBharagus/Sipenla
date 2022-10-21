<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use URL;


class AdmissionController extends Controller
{

    public function saveImage($image, $path='public')
    {
        try{
            if (!$image) {
                return null;
            }

            $filename = time() . '.png';
            // save image
            Storage::disk($path)->put($filename, base64_decode($image));

            //return the path
            // Url is the base url exp: localhost:8000
            return URL::to('/') . '/storage/' . $path . '/' . $filename;
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

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

            $image = $this->saveImage($request->profile_employee, "posts");

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
                'company_id' => 1,
                "image" => $image,
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

            $validate = Validator::make($data, [
                'first_name' => 'required',
                'last_name' => 'required',
                'nik' => 'required|unique:students,nik|size:16',
                'nisn' => 'required|unique:students,nik|size:16',
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
                'date_school_now' => 'required',
                'family_profession' => 'required',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $image = $this->saveImage($request->profile_student, "students");

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
                'date_school_now' => $data['date_school_now'],
                'family_profession' => $data['family_profession'],
                'phone' => $data['phone'],
                'image' => $image,
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

    public function getStudent()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();
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

    public function getEmployee()
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
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

    public function updateStudent(Request $request, $id)
    {
        try{
            $image = $this->saveImage($request->profile_student, "students");

            $edit = [
                "image" => $image,
            ];

            $updateStudent = Student::where('student_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Profile Student Has Been Updated');
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function updateEmployee(Request $request, $id)
    {
        try{
            $image = $this->saveImage($request->profile_employee, "posts");

            $edit = [
                "image" => $image,
            ];

            $updateEmployee = Employee::where('employee_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Profile Employee Has Been Updated');
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
