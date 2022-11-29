<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class MasterStudentController extends Controller
{
    public function index(){
        $student = Student::join('users','students.user_id', '=', 'users.id')
        // ->join('student_grades', 'students.student_id', '=', 'student_grades.student_id')
        // ->join('grades', 'student_grades.grade_id', '=', 'grades.grade_id')
        ->join('extracurriculars', 'students.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
        ->where('role' ,'=','student')->get();
        return view('pages.master.master-siswa', compact('student'));
    }

    public function delete($id){
        try {
            Student::where('user_id', $id)->delete();
            User::where('id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted Student Data!"]);
    }

    public function edit($id)
    {
        $where = array('student_id' => $id);
        $post  = Student::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = Student::where('student_id', $id);
        $student->update($data);
    }
}
