<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\Validator;

class EkstrakurikulerController extends Controller
{
    public function index(){
        $extra = Extracurricular::orderBy('created_at', 'desc')->get();
        return view('pages.master.master-extra', compact('extra'));
    }

    public function store(Request $request){
        $data = $request->all();
        $validate = Validator::make($data,[
                'extracurricular_name' => 'required',
            ],
            [
                'extracurricular_name.required' => 'Nama Mata Pelajaran Harus Diisi.',
            ]
        );
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $CreateSubject = Extracurricular::create([
            'extracurricular_name' => $data['extracurricular_name'],
        ]);

        return redirect('/ekstrakurikuler');
    }

    public function delete($id){
        $ekstra = Extracurricular::where('extracurricular_id', $id);
        $ekstra->delete();
        return redirect('/ekstrakurikuler');
    }
}
