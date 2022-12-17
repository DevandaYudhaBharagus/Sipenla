<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Employee;
use App\Models\Student;
use App\Models\StudentGrade;
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

        return response()->json(["error" => false, "message" => "Sukses Menghapus Data Kelas!"]);
    }

    public function viewKelasSiswa()
    {

        $siswa = Student::all();
        $grade = Grade::all();

        $kelas = StudentGrade::join('grades', 'student_grades.grade_id', '=', 'grades.grade_id')
                ->join('employees', 'grades.teacher_id', '=', 'employees.employee_id')
                ->groupBy('student_grades.grade_id')
                ->get();

        return view('pages.master.master-kelas-siswa', compact('siswa', 'grade', 'kelas'));
    }

    public function gradeStore(Request $request){
        $datas = $request->grade_id;
        $studenData= $request->student_id;

        foreach($studenData as $data){
            StudentGrade::create([
                'grade_id' => $datas,
                'student_id' => $data,
            ]);
        }

        return response()->json([
            "error" => false,
            "message" => "Successfuly Added Shift Data!"
        ]);
    }

    public function deleteGrade($id){
        try {
            StudentGrade::where('grade_id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Sukses Menghapus Data Kelas!"]);
    }
}
