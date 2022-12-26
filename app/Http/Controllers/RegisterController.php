<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.daftar.daftar-blank');
    }

    public function registeremployee()
    {
        return view('pages.daftar.daftar-pegawai');
    }
    public function registerstudent()
    {
        return view('pages.daftar.daftar-siswa');
    }
    public function registerwalimuird()
    {
        $students = Student::get();
        return view('pages.daftar.daftar-walmur', compact('students'));
    }

    public function addUser(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data,[
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => 'required',
        ],
        [
            'email.required' => 'Email Harus Diisi.',
            'email.email' => 'Email Harus Format Email.',
            'password.required' => 'Password Harus Diisi.',
            'password.confirmed' => 'Password yang anda masukkan tidak sama.',
        ]
    );

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $CreateUser = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);

        return redirect('/dashboard')->with('status', 'Berhasil Daftar');
    }

    public function addGuardian(Request $request)
    {
            $data = $request->all();

            $validate = Validator::make($data,[
                'email' => 'required|email',
                'password' => 'required|confirmed',
                'role' => 'required',
            ],
            [
                'email.required' => 'Email Harus Diisi.',
                'email.email' => 'Email Harus Format Email.',
                'password.required' => 'Password Harus Diisi.',
                'password.confirmed' => 'Password yang anda masukkan tidak sama.',
            ]
        );

            if ($validate->fails()) {
                return response()->json([
                    'error' => $validate->errors()->toArray()
                ]);
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


            return redirect('/dashboard')->with('status', 'Berhasil Daftar');
    }

}
