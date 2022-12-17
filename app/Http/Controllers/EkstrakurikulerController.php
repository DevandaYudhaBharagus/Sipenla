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

        return response()->json([
            "error" => false,
            "message" => "Successfuly Added Shift Data!"
        ]);
    }

    public function edit($id)
    {
        $where = array('extracurricular_id' => $id);
        $post  = Extracurricular::where($where)->first();
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = Extracurricular::where('extracurricular_id', $id);
        $student->update($data);
    }

    public function delete($id){
        try {
            Extracurricular::where('extracurricular_id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Sukses Menghapus Data Ekstrakurikuler!"]);
    }
}
