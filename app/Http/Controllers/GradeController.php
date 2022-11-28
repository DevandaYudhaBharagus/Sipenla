<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function index(){
        $grades = Grade::join('employees', 'grades.teacher_id', '=', 'employees.employee_id')
        ->get();

        $teacher = Employee::join('users','employees.user_id', '=', 'users.id')
        ->join('workshifts','employees.workshift_id','=','workshifts.workshift_id')
        ->where('role' ,'=','guru')->get();
        return view('pages.master.master-kelas', compact('grades','teacher'));
    }

    public function store(Request $request){
        $data = $request->all();
        $validate = Validator::make($data,[
            'grade_name' => 'required',
            'teacher_id' => 'required',
        ],
        [
            'grade_name.required' => 'Nama Kelas Harus Diisi.',
            'teacher_id.required' => 'Wali Kelas Harus Diisi.',
        ]
    );
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $CretaeGrade = Grade::create([
            'grade_name' => $data['grade_name'],
            'teacher_id' => $data['teacher_id'],
        ]);

        return response()->json([
            "error" => false,
            "message" => "Successfuly Added Shift Data!"
        ]);
    }

    public function edit($id)
    {
        $where = array('grade_id' => $id);
        $post  = Grade::join('employees', 'grades.teacher_id', '=', 'employees.employee_id')->where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = Grade::where('grade_id', $id);
        $student->update($data);
    }

    public function delete($id){
        try {
            Grade::where('grade_id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted Shift Data!"]);
    }
}
