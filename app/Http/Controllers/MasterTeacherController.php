<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterTeacherController extends Controller
{
    public function index(){
        $teacher = Employee::join('users','employees.user_id', '=', 'users.id')
        ->join('workshifts','employees.workshift_id','=','workshifts.workshift_id')
        ->where('role' ,'=','guru')->get();
        return view('pages.master.master-guru', compact('teacher'));
    }

    public function delete($id){
        $employee = Employee::where('user_id', $id);
        $user = User::where('id', $id);
        $employee->delete();
        $user->delete();
        return redirect('/teacher');
    }
}
