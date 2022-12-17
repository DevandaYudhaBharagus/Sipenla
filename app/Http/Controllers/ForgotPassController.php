<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;

class ForgotPassController extends Controller
{
    public function index()
    {
        return view('auth.lupa-sandi');
    }

    public function getOtp()
    {
        return view('auth.otp');
    }

    public function getUpdate()
    {
        return view('auth.new-pass');
    }

    public function postEmail(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data,[
            'email' => 'required|email|exists:users',
        ],
        [
            'email.required' => 'Email Harus Diisi.',
            'email.email' => 'Email Harus Format Email.',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
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

        return redirect('/otp')->with('status', 'We have e-mailed your password reset link!');
    }

    public function postOtp(Request $request)
    {
        $token = $request->all();
        $fix = $token['number1'].$token['number2'].$token['number3'].$token['number4'];

        $user = PasswordReset::where(['token' => $fix])->first();
        if(!$user) {
            return response()->json([
                'error' => "Invalid Token"
            ]);
        }

        return view('auth.new-pass', compact('fix'));
    }

    public function updatePass(Request $request)
    {
        $token = $request->only('token');
        $data = $request->all();

        $validate = Validator::make($data,[
            'token' => 'required',
            'password' => 'required|confirmed'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $user = PasswordReset::where(['token' => $token])->first();
        if(!$user){
            return response()->json([
                'error' => "Invalid Token"
            ]);
        }

        User::where('email', $user->email)->update(['password' => bcrypt($request->password)]);
        PasswordReset::where(['email' => $user->email, 'token' => $token])->delete();

        return redirect('/login')->with('status', 'Password Terganti!');
    }
}
