<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index(){
        $subcject = Subject::all();
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

        return redirect('/subject');
    }

    public function delete($id){
        $subcject = Subject::where('subject_id', $id);
        $subcject->delete();
        return redirect('/subject');
    }
}
