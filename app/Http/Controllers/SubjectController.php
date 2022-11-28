<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index(){
        $subcject = Subject::orderBy('created_at', 'desc')->get();
        return view('pages.master.master-mapel', compact('subcject'));
    }

    public function store(Request $request){
        $data = $request->all();
        $validate = Validator::make($data,[
                'subject_name' => 'required',
            ],
            [
                'subject_name.required' => 'Nama Mata Pelajaran Harus Diisi.',
            ]
        );
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $CreateSubject = Subject::create([
            'subject_name' => $data['subject_name'],
        ]);

        return response()->json([
            "error" => false,
            "message" => "Successfuly Added Shift Data!"
        ]);
    }

    public function edit($id)
    {
        $where = array('subject_id' => $id);
        $post  = Subject::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = Subject::where('subject_id', $id);
        $student->update($data);
    }

    public function delete($id){
        try {
            Subject::where('subject_id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted Subjecr Data!"]);
    }
}
