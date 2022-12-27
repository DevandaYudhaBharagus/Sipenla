<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Guardian;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentWebController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->role == "student"){
            $student = Student::where('user_id', '=', $user->id)->first();
    
            $transaction = Transaction::where('user_id', '=', $user->id)
            ->get();
            return view('pages.keuangan.dash-keuangan', compact('transaction','student'));
        }else if ($user->role == "walimurid") {
            $guardian = Guardian::where('student_guardians.user_id', '=', $user->id)
            ->join('students', 'student_guardians.student_id', '=', 'students.student_id')
            ->first();
    
            $transaction = Transaction::where('user_id', '=', $user->id);


            return view('pages.keuangan.dash-keuangan', compact('transaction','guardian'));
    }
        $employee = Employee::where('user_id', '=', $user->id)->first();
        $transaction = Transaction::where('user_id', '=', $user->id)
        ->get();
        return view('pages.keuangan.dash-keuangan', compact('transaction','employee'));
      
    }
}
