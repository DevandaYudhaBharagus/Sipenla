<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)
                    ->join('users', 'user_id', '=', 'users.id')
                    // ->join('workshifts','employees.workshift_id','=','workshifts.workshift_id')
                    ->first();
        $date = ($employee->date_of_birth !== null) ? date('d F Y', strtotime($employee->date_of_birth)) : '';
        $employee->date_of_birth = $date;

        return view('pages.tabel-data.data-form-pegawai', compact('employee'));
    }

    public function getDataPegawai(){
       
    }
}
