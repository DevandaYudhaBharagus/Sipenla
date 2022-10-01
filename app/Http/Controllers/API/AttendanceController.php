<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\LeaveApplication;
use App\Models\Employee;
use App\Models\OfficialDuty;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function addLeave(Request $request)
    {
        try{
            $data = $request->all();
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();

            $validate = Validator::make($data, [
                'leave_type_id' => 'required',
                'application_from_date' => 'required',
                'application_to_date' => 'required|after:application_from_date',
                'purpose' => 'required'
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];
                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $leaveData = LeaveApplication::create([
                'employee_id' => $employee->employee_id,
                'leave_type_id' => $data['leave_type_id'],
                'application_from_date' => $data['application_from_date'],
                'application_to_date' => $data['application_to_date'],
                'application_date' => Carbon::now(),
                'purpose' => $data['purpose'],
            ]);

            return ResponseFormatter::success( "Succeed to added leave.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function addDuty(Request $request)
    {
        try{
            $data = $request->all();
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();

            $validate = Validator::make($data, [
                'duty_from_date' => 'required',
                'duty_to_date' => 'required|after:duty_from_date',
                'purpose' => 'required',
                'attachment' => 'required|mimes:pdf, jpeg, jpg, png'
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];
                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            if ($request->file('attachment')) {
                $test['attachment'] = $request->file('attachment')->store('attachment');
            }

            $leaveData = OfficialDuty::create([
                'employee_id' => $employee->employee_id,
                'duty_from_date' => $data['duty_from_date'],
                'duty_to_date' => $data['duty_to_date'],
                'duty_date' => Carbon::now(),
                'purpose' => $data['purpose'],
                'attachment' => $test['attachment']
            ]);

            return ResponseFormatter::success( "Succeed to added duty.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
