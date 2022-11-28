<?php

namespace App\Http\Controllers;

use App\Models\Workshift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShiftController extends Controller
{
    public function index(){
        $shifts = Workshift::all();
        return view('pages.master.master-shift', compact('shifts'));
    }

    public function store(Request $request){
        $data = $request->all();
        $validate = Validator::make($data,[
                'shift_name' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'max_arrival' => 'required',
            ],
            [
                'shift_name.required' => 'Nama Shift Harus Diisi.',
                'start_time.required' => 'Jam Mulai Harus Diisi.',
                'end_time.required' => 'Jam Akhir Harus Diisi.',
                'max_arrival.required' => 'Batas Waktu Kedatangan Harus Diisi.',
            ]
        );
        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $CreateWorkShift = Workshift::create([
            'company_id' => 1,
            'shift_name' => $data['shift_name'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'max_arrival' => $data['max_arrival'],
        ]);

        return redirect('/workshift');
    }

    public function delete($id){
        $wokrshifts = Workshift::where('workshift_id', $id);
        $wokrshifts->delete();
        return redirect('/workshift');
    }
}
