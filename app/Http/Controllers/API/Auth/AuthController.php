<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\Employee;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\LeaveBalance;
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

            $employeeData = $data;

            $validate = Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'role' => 'required',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            if($request->role == "admin"){
                return ResponseFormatter::error("sorry you can't register admin", 400);
            }

            $userData = User::create([
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => $data['role']
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

            $guardianData = $data;

            $validate = Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'student_id' => 'required',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $userData = User::create([
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 'walimurid'
            ]);

            $userData = Guardian::create([
                'user_id' => $userData['id'],
                'student_id' => $data['student_id']
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

            $studentData = $data;

            $validate = Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $userData = User::create([
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 'student'
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
                $response = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                ];
                return ResponseFormatter::success($response, 'Authenticated Success');
            }else if($user->role == "walimurid"){
                $response = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
                ];
                return ResponseFormatter::success($response, 'Authenticated Success');
            }else{
                $response = [
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user,
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
            $token = mt_rand(1000, 9999);

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

    public function getOtp(Request $request){
        try{
            $token = $request->only('token');

            $request->validate([
                'token' => 'required'
            ]);

            $user = PasswordReset::where(['token' => $token])->first();
            if(!$user) return ResponseFormatter::error('Invalid Token', 400);

            $response = [
                $token
            ];
            return ResponseFormatter::success($response, 'Lets Change Password');
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function updatePass(Request $request){
        try{
            $token = $request->only('token');

            $request->validate([
                'token' => 'required',
                'password' => 'required|confirmed'
            ]);

            $user = PasswordReset::where(['token' => $token])->first();
            if(!$user) return ResponseFormatter::error('Invalid Token', 400);

            User::where('email', $user->email)->update(['password' => bcrypt($request->password)]);
            PasswordReset::where(['email' => $user->email, 'token' => $token])->delete();

            return ResponseFormatter::success('Your password has been changed!');
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
