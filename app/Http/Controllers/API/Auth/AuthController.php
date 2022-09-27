<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\Employee;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function registerEmployee(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            $employeeData = $data;

            $validate = Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'nik' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'phone' => 'required|max:13',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $test = User::where('email', '=', $request->email);
            $test1 = Employee::where('nik', '=', $request->nik);
            if ($test->exists() || $test1->exists()) {
                return ResponseFormatter::error("Email or Residential Identity Card already taken", 400);
            }

            $userData = User::create([
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role']
            ]);

            $createEmployee = Employee::create([
                'user_id' => $userData['id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'nik' => $data['nik'],
                'place_of_birth' => $data['place_of_birth'],
                'date_of_birth' => $data['date_of_birth'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'phone' => $data['phone']
            ]);

            return ResponseFormatter::success( "Succeed to added account.");

        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function registerGuardian(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            $guardianData = $data;

            $validate = Validator::make($data, [
                'email' => 'required|email',
                'student_id' => 'required',
                'password' => 'required',
                'guardian_name' => 'required',
                'no_kk' => 'required',
                'phone' => 'required|max:13',
                'address' => 'required',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $test = User::where('email', '=', $request->email);
            $test1 = Guardian::where('no_kk', '=', $request->no_kk);
            if ($test->exists() || $test1->exists()) {
                return ResponseFormatter::error("Email or Family Card already taken", 400);
            }

            $userData = User::create([
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'walimurid'
            ]);

            $createGuardian = Guardian::create([
                'user_id' => $userData['id'],
                'student_id' => $data['student_id'],
                'guardian_name' => $data['guardian_name'],
                'no_kk' => $data['no_kk'],
                'phone' => $data['phone'],
                'address' => $data['address']
            ]);

            return ResponseFormatter::success( "Succeed to added account.");

        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function registerStudent(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            $studentData = $data;

            $validate = Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required',
                'nisn' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'father_name' => 'required',
                'mother_name' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'phone' => 'required|max:13',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $test = User::where('email', '=', $request->email);
            $test1 = Student::where('nisn', '=', $request->nisn);
            if ($test->exists() || $test1->exists()) {
                return ResponseFormatter::error("Email or Residential NISN already taken", 400);
            }

            $userData = User::create([
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'student'
            ]);

            $createStudent = Student::create([
                'user_id' => $userData['id'],
                'nisn' => $data['nisn'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'father_name' => $data['father_name'],
                'mother_name' => $data['mother_name'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'place_of_birth' => $data['place_of_birth'],
                'date_of_birth' => $data['date_of_birth'],
                'address' => $data['address']
            ]);

            return ResponseFormatter::success( "Succeed to added account.");

        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            $validate = Validator::make($credentials, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            if (!Auth::attempt($credentials)) {
                $messages = 'This account doesn\'t exist or wrong password.';

                throw new Exception($messages, 401);
            }

            $user = User::where('email', $request['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            if($user->role == "student"){
                $student = Student::where('user_id', $user->id)->firstOrFail();
                $response = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                    'student' => $student
                ];
                return ResponseFormatter::success($response, 'Authenticated Success');
            }else if($user->role == "walimurid"){
                $guardian = Guardian::where('user_id', $user->id)->firstOrFail();
                $response = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                    'student' => $guardian
                ];
                return ResponseFormatter::success($response, 'Authenticated Success');
            }else{
                $employee = Employee::where('user_id', $user->id)->firstOrFail();
                $response = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                    'employee' => $employee
                ];
                return ResponseFormatter::success($response, 'Authenticated Success');
            }
        }

        catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function forgot(Request $request){
        try {
            $credentials = $request->only('email');

            $validate = Validator::make($credentials, [
                'email' => 'required|email|exists:users',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }
            $email = PasswordReset::where('email', '=', $request->email);
            if ($email->exists()) {
                $email->delete();
            }
            $token = Str::random(60);

            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send('auth.click', ['token' => $token], function ($message) use ($request) {
                $message->from(env('MAIL_FROM_ADDRESS'));
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });
            $response = [
                'messages' => 'Success'
            ];

            return ResponseFormatter::success($response, 'Email Was Sent');
        } catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }
}
