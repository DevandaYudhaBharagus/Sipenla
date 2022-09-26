<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\Employee;
use App\Models\User;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Exception;

class AuthController extends Controller
{
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
}
