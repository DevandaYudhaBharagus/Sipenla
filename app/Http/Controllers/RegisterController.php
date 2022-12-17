<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.registrasi');
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

        return redirect('/dashboard')->with('status', 'Berhasil Re');
    }

}
