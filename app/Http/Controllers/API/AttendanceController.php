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
use App\Models\LeaveType;
use App\Models\Attendance;
use Illuminate\Support\Str;
use DateTime;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function addLeave(Request $request)
    {
        try{
            $data = $request->all();
            // dd($data);
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();

            $validate = Validator::make($data, [
                'leave_type_id' => 'required',
                'application_from_date' => 'required',
                'application_to_date' => 'required|after:application_from_date',
                'purpose' => 'required',
                'abandoned_job' => 'required'
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];
                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $start = Carbon::parse($data['application_from_date']);
            $end = Carbon::parse($data['application_to_date']);
            $diffDate = $end->diffInDays($start);

            $leaveData = LeaveApplication::create([
                'employee_id' => $employee->employee_id,
                'leave_type_id' => $data['leave_type_id'],
                'application_from_date' => $data['application_from_date'],
                'application_to_date' => $data['application_to_date'],
                'application_date' => Carbon::now(),
                'purpose' => $data['purpose'],
                'abandoned_job' => $data['abandoned_job'],
            ]);

            return ResponseFormatter::success( "Succeed to added leave.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getLeaveType()
    {
        try{
            $user = Auth::user();
            $employee = Employee::join('leave_balances', 'employees.employee_id', '=', 'leave_balances.employee_id')->where('user_id', '=', $user->id)->first();
            $leaveType = LeaveType::all();

            $response = [
                'leave_type' => $leaveType,
                'leave_quota' => $employee->total_balance
            ];

            return ResponseFormatter::success($response, 'Get News Success');
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
                'attachment' => 'required|mimes:pdf, jpeg, jpg, png',
                'time' => 'required',
                'place' => 'required',
                'abandoned_job' => 'required'
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
                'time' => Carbon::createFromFormat('H:i:s', $data['time']),
                'place' => $data['place'],
                'abandoned_job' => $data['abandoned_job'],
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

    public function checkIn()
    {
        try{
            $timeNow = Carbon::now();
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();

            $return = Attendance::create([
                "employee_id" => $employee->employee_id,
                "date" => $timeNow,
                "check_in" => $timeNow,
            ]);
            return ResponseFormatter::success( "Succeed Check-in.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function checkOut()
    {
        try{
            $timeNow = Carbon::now();
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();

            $checkOut = Attendance::where('employee_id', '=', $employee->employee_id)->whereDate('date', $timeNow);

            $data = [
                "check_out" => $timeNow,
                "status" => "ac"
            ];

            $checkOut->update($data);
            return ResponseFormatter::success( "Succeed Check-out.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyAttendance()
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $attendance = Attendance::where('employee_id', '=', $employee->employee_id)
                        ->orderBy('created_at', 'asc')
                        ->get();

            $week = [];

            foreach ($attendance as $att) {
                $x = Carbon::parse($att->date)->format('W');
                array_push($week, (object)["week"=>$x]);
            }

            $unique = collect($week)->unique('week')->values()->all();

            $response = $unique;

            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyAll()
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $attendance = Attendance::where('employee_id', '=', $employee->employee_id)
                        ->get();

            foreach ($attendance as $att) {
                $time = $att->date;
                $test2 = ($att->created_at !== null) ? date('d F Y', strtotime($time)) : '';
                $att->date = $test2;
            }

            $response =  $attendance;
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
