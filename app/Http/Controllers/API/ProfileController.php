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
                $student = Student::join('student_grades', 'students.student_id', '=', 'student_grades.student_id')
                            ->join('grades', 'student_grades.grade_id', '=', 'grades.grade_id')
                            ->Join('employees', 'grades.teacher_id', '=', 'employees.employee_id')
                            ->join('extracurriculars', 'students.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                            ->where('students.user_id', '=', $user->id)
                            ->first([
                                'students.student_id',
                                'students.nisn',
                                'students.father_name',
                                'students.mother_name',
                                'students.gender',
                                'students.phone',
                                'students.place_of_birth',
                                'students.date_of_birth',
                                'students.address',
                                'students.religion',
                                'students.image',
                                'students.first_name as student_first_name',
                                'students.last_name as student_last_name',
                                'employees.first_name as employee_first_name',
                                'employees.last_name as employee_last_name',
                                'grades.grade_id',
                                'grades.grade_name',
                                'extracurriculars.extracurricular_id',
                                'extracurriculars.extracurricular_name',
                                'students.status'
                            ]);
                if(!$student){
                    $murid = Student::where('user_id', '=', $user->id)
                            ->join('extracurriculars', 'students.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                            ->first();
                    if(!$murid){
                        $response = [
                            'student_id' => 0,
                            'nisn' => "-",
                            'student_first_name' => "-",
                            'student_last_name' => "-",
                            'father_name' => "-",
                            'mother_name' => "-",
                            'gender' => "-",
                            'phone' => "-",
                            'place_of_birth' => "-",
                            'date_of_birth' => "-",
                            'address' => "-",
                            'religion' => "-",
                            'image' => null,
                            'grade_id' => 0,
                            'grade_name' =>"-",
                            'employee_first_name' => "-",
                            'employee_last_name' => "-",
                            'extracurricular_id' => 0,
                            'extracurricular_name' => "-",
                            'status' => 'false',
                            'status_student' => '-'
                        ];

                        return ResponseFormatter::success($response, 'Get User');
                    }
                    $date = ($murid->date_of_birth !== null) ? date('d F Y', strtotime($murid->date_of_birth)) : '';
                    $murid->date_of_birth = $date;
                    $response = [
                        'student_id' => $murid->student_id,
                        'nisn' => $murid->nisn,
                        'student_first_name' => $murid->first_name,
                        'student_last_name' => $murid->last_name,
                        'father_name' => $murid->father_name,
                        'mother_name' => $murid->mother_name,
                        'gender' => $murid->gender,
                        'phone' => $murid->phone,
                        'place_of_birth' => $murid->place_of_birth,
                        'date_of_birth' => $murid->date_of_birth,
                        'address' => $murid->address,
                        'religion' => $murid->religion,
                        'image' => $murid->image,
                        'grade_id' => 0,
                        'grade_name' => "-",
                        'employee_first_name' => "-",
                        'employee_last_name' => "-",
                        'extracurricular_id' => $murid->extracurricular_id,
                        'extracurricular_name' => $murid->extracurricular_name,
                        'status_student' => $murid->status,
                        'status' => 'true'
                    ];

                    return ResponseFormatter::success($response, 'Get User');
                }
                $date = ($student->date_of_birth !== null) ? date('d F Y', strtotime($student->date_of_birth)) : '';
                $student->date_of_birth = $date;
                $response = [
                    'student_id' => $student->student_id,
                    'nisn' => $student->nisn,
                    'student_first_name' => $student->student_first_name,
                    'student_last_name' => $student->student_last_name,
                    'father_name' => $student->father_name,
                    'mother_name' => $student->mother_name,
                    'gender' => $student->gender,
                    'phone' => $student->phone,
                    'place_of_birth' => $student->place_of_birth,
                    'date_of_birth' => $student->date_of_birth,
                    'address' => $student->address,
                    'religion' => $student->religion,
                    'image' => $student->image,
                    'grade_id' => $student->grade_id,
                    'grade_name' => $student->grade_name,
                    'employee_first_name' => $student->employee_first_name,
                    'employee_last_name' => $student->employee_last_name,
                    'extracurricular_id' => $student->extracurricular_id,
                    'extracurricular_name' => $student->extracurricular_name,
                    'status_student' => $student->status,
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
                $employee = Employee::where('user_id', '=', $user->id)->join('grades', 'employees.employee_id', '=', 'grades.teacher_id')->first();
                if(!$employee){
                    $pembina = Employee::where('user_id', '=', $user->id)
                    ->join('extra_schedules', 'employees.employee_id', '=', 'extra_schedules.teacher_id')
                    ->join('extracurriculars', 'extra_schedules.extracurricular_id', 'extracurriculars.extracurricular_id')
                    ->first();
                    if(!$pembina){
                        $employeeNotWali = Employee::where('user_id', '=', $user->id)->first();
                        if(!$employeeNotWali){
                            $response = [
                                'employee_id' => 0,
                                'nuptk' => "-",
                                'first_name' => "-",
                                'last_name' => "-",
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
                                'status' => "false",
                                'isWali' => "-",
                                'extracurricular_id' => 0,
                                'extracurricular' => '-'
                            ];

                            return ResponseFormatter::success($response, 'Get User');
                        }

                        $response = [
                            'employee_id' => $employeeNotWali->employee_id,
                            'nuptk' => $employeeNotWali->nuptk,
                            'first_name' => $employeeNotWali->first_name,
                            'last_name' => $employeeNotWali->last_name,
                            'npsn' => $employeeNotWali->npsn,
                            'place_of_birth' => $employeeNotWali->place_of_birth,
                            'date_of_birth' => $employeeNotWali->date_of_birth,
                            'gender' => $employeeNotWali->gender,
                            'religion' => $employeeNotWali->religion,
                            'address' => $employeeNotWali->address,
                            'education' => $employeeNotWali->education,
                            'family_name' => $employeeNotWali->family_name,
                            'family_address' => $employeeNotWali->family_address,
                            'position' => $employeeNotWali->position,
                            'image' => $employeeNotWali->image,
                            'status' => 'true',
                            'isWali' => 'false',
                            'extracurricular_id' => 0,
                            'extracurricular' => '-'
                        ];

                        return ResponseFormatter::success($response, 'Get User');
                    }

                    $response = [
                        'employee_id' => $pembina->employee_id,
                        'nuptk' => $pembina->nuptk,
                        'first_name' => $pembina->first_name,
                        'last_name' => $pembina->last_name,
                        'npsn' => $pembina->npsn,
                        'place_of_birth' => $pembina->place_of_birth,
                        'date_of_birth' => $pembina->date_of_birth,
                        'gender' => $pembina->gender,
                        'religion' => $pembina->religion,
                        'address' => $pembina->address,
                        'education' => $pembina->education,
                        'family_name' => $pembina->family_name,
                        'family_address' => $pembina->family_address,
                        'position' => $pembina->position,
                        'image' => $pembina->image,
                        'status' => 'true',
                        'isWali' => 'false',
                        'extracurricular_id' => $pembina->extracurricular_id,
                        'extracurricular' => $pembina->extracurricular_name
                    ];

                    return ResponseFormatter::success($response, 'Get User');
                }
                $date = ($employee->date_of_birth !== null) ? date('d F Y', strtotime($employee->date_of_birth)) : '';
                $employee->date_of_birth = $date;
                $response = [
                    'employee_id' => $employee->employee_id,
                    'nuptk' => $employee->nuptk,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
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
                    'status' => 'true',
                    'isWali' => 'true',
                    'extracurricular_id' => 0,
                    'extracurricular' => '-'
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

    public function getGuardian()
    {
        try{
            $user = Auth::user();
            $guardian = Guardian::where('student_guardians.user_id', '=', $user->id)
            ->join('students', 'student_guardians.student_id', '=', 'students.student_id')
            ->join('student_grades', 'students.student_id', '=', 'student_grades.student_id')
            ->first([
                'student_guardians.user_id',
                'student_guardians.student_id',
                'students.image',
                'guardian_id',
                'nisn',
                'first_name',
                'last_name',
                'father_name',
                'mother_name',
                'gender',
                'student_guardians.phone',
                'place_of_birth',
                'date_of_birth',
                'date_school_now',
                'address',
                'religion',
                'school_origin',
                'school_now',
                'parent_address',
                'mother_profession',
                'father_profession',
                'mother_education',
                'father_education',
                'family_address',
                'family_profession',
                'grade_id'
            ]);
            if(!$guardian){
                $wali = Guardian::where('student_guardians.user_id', '=', $user->id)
                        ->join('students', 'student_guardians.student_id', '=', 'students.student_id')
                        ->first([
                            'student_guardians.user_id',
                            'student_guardians.student_id',
                            'students.image',
                            'guardian_id',
                            'nisn',
                            'first_name',
                            'last_name',
                            'father_name',
                            'mother_name',
                            'gender',
                            'student_guardians.phone',
                            'place_of_birth',
                            'date_of_birth',
                            'date_school_now',
                            'address',
                            'religion',
                            'school_origin',
                            'school_now',
                            'parent_address',
                            'mother_profession',
                            'father_profession',
                            'mother_education',
                            'father_education',
                            'family_address',
                            'family_profession'
                        ]);

                if(!$wali){
                    return ResponseFormatter::error('Not Found', 404);
                }

                $date = ($guardian->date_of_birth !== null) ? date('d F Y', strtotime($guardian->date_of_birth)) : '';
                $dateSchool = ($guardian->date_school_now !== null) ? date('d F Y', strtotime($guardian->date_school_now)) : '';
                $guardian->date_of_birth = $date;
                $guardian->date_school_now = $date;
                $response = [
                    'guardian_id' => $guardian->guardian_id,
                    'user_id' => $guardian->user_id,
                    'student_id' => $guardian->student_id,
                    'nisn' => $guardian->nisn,
                    'first_name' => $guardian->first_name,
                    'last_name' => $guardian->last_name,
                    'father_name' => $guardian->father_name,
                    'mother_name' => $guardian->mother_name,
                    'gender' => $guardian->gender,
                    'place_of_birth' => $guardian->place_of_birth,
                    'date_of_birth' => $guardian->date_of_birth,
                    'date_school_now' => $guardian->date_school_now,
                    'address' => $guardian->address,
                    'religion' => $guardian->religion,
                    'school_origin' => $guardian->school_origin,
                    'school_now' => $guardian->school_now,
                    'parent_address' => $guardian->parent_address,
                    'mother_profession' => $guardian->mother_profession,
                    'father_profession' => $guardian->father_profession,
                    'mother_education' => $guardian->mother_education,
                    'father_education' => $guardian->father_education,
                    'family_address' => $guardian->family_address,
                    'family_profession' => $guardian->family_profession,
                    'phone' => $guardian->phone,
                    'image' => $guardian->image,
                    'grade_id' => 0,
                    'status' => 'true',
                ];
                return ResponseFormatter::success($response, 'Get Wali Murid');
            }
            $date = ($guardian->date_of_birth !== null) ? date('d F Y', strtotime($guardian->date_of_birth)) : '';
            $dateSchool = ($guardian->date_school_now !== null) ? date('d F Y', strtotime($guardian->date_school_now)) : '';
            $guardian->date_of_birth = $date;
            $guardian->date_school_now = $date;
            $response = [
                'guardian_id' => $guardian->guardian_id,
                'user_id' => $guardian->user_id,
                'student_id' => $guardian->student_id,
                'nisn' => $guardian->nisn,
                'first_name' => $guardian->first_name,
                'last_name' => $guardian->last_name,
                'father_name' => $guardian->father_name,
                'mother_name' => $guardian->mother_name,
                'gender' => $guardian->gender,
                'place_of_birth' => $guardian->place_of_birth,
                'date_of_birth' => $guardian->date_of_birth,
                'date_school_now' => $guardian->date_school_now,
                'address' => $guardian->address,
                'religion' => $guardian->religion,
                'school_origin' => $guardian->school_origin,
                'school_now' => $guardian->school_now,
                'parent_address' => $guardian->parent_address,
                'mother_profession' => $guardian->mother_profession,
                'father_profession' => $guardian->father_profession,
                'mother_education' => $guardian->mother_education,
                'father_education' => $guardian->father_education,
                'family_address' => $guardian->family_address,
                'family_profession' => $guardian->family_profession,
                'phone' => $guardian->phone,
                'image' => $guardian->image,
                'grade_id' => $guardian->grade_id,
                'status' => 'true',
            ];
            return ResponseFormatter::success($response, 'Get Wali Murid');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
