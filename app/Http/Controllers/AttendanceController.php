<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\LeaveApplication;
use App\Models\OfficialDuty;
use App\Models\Workday;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{

    public function saveImage($image, $path='public')
    {
        if (!$image) {
            return null;
        }

        $filename = time() . '.png';
        // save image
        Storage::disk($path)->put($filename, base64_decode($image));

        //return the path
        // Url is the base url exp: localhost:8000
        $urls = env("AZURE_STORAGE_URL") . env("AZURE_STORAGE_CONTAINER") . "/" . $filename;
        return $urls;
    }

    public function index()
    {
        return view('pages.absensi.absensi-webcam');
    }

    public function absensi()
    {
        $user = Auth::user();
        $employee = Employee::join('leave_balances', 'employees.employee_id', '=', 'leave_balances.employee_id')->where('user_id', '=', $user->id)->first();
        $attendance = Attendance::where('employee_id', $employee->employee_id)->whereNull('check_out')->where('date', date("Y-m-d"))->first();

        $byweek = Attendance::where('employee_id', $employee->employee_id)
                    ->get()
                    ->groupBy(function($date) {
                        return Carbon::parse($date->date)->format('W');
                    });

        $byweek = $byweek->reverse();

        $leave = LeaveType::get();

        return view('pages.absensi.absensi', compact('employee', 'attendance', 'byweek', 'leave'));
    }

    public function absensiKeluar()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
        $attendance = Attendance::where('employee_id', $employee->employee_id)->where('date', date("Y-m-d"))->first();

        return view('pages.absensi.absensi-keluar', compact('attendance'));
    }

    public function checkin(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
        $date = Carbon::now();
        $day = Carbon::parse($date);
        $day->settings(['formatFunction' => 'translatedFormat']);

        $leave = LeaveApplication::where('employee_id', '=', $employee->employee_id)
                -> whereDate('application_from_date', '<=', $date)
                -> whereDate('application_to_date', '>=', $date)
                ->get();

        $duty = OfficialDuty::where('employee_id', '=', $employee->employee_id)
                -> whereDate('duty_from_date', '<=', $date)
                -> whereDate('duty_to_date', '>=', $date)
                ->get();

        $hasCheckedIn = Attendance::whereDate('date', $date)
                        ->where('employee_id', $employee->employee_id)
                        ->exists();

        $notWorkingDay = Workday::join('days', 'workdays.days_id', '=', 'days.day_id')
                        ->join('workshifts', 'workdays.workshift_id', '=', 'workshifts.workshift_id')
                        ->where('days.day_name', '=', $day->format('l'))
                        ->where('workdays.company_id', '=', $employee->company_id)
                        ->where('workdays.workshift_id', '=', $employee->workshift_id)
                        ->get();

        if (count($leave) > 0) {
            return response()->json([
                'error' => "Anda sedang dalam periode cuti/izin"
            ]);
        }

        if (count($duty) > 0) {
            return response()->json([
                'error' => "Anda sedang dalam periode Tugas Dinas"
            ]);
        }

        if (count($notWorkingDay) <= 0) {
            return response()->json([
                'error' => "Hari ini bukan hari kerja"
            ]);
        }

        foreach($notWorkingDay as $work) {
            if($date->format('H:i:s') > $work->end_time) {
                return response()->json([
                    'error' => "Jam Kerja Telah Usai"
                ]);
            } elseif($date->format('H:i:s') < $work->start_time) {
                return response()->json([
                    'error' => "Jam Kerja Belum Mulai"
                ]);
            }
        }

        if($hasCheckedIn) {
            return response()->json([
                'error' => "Anda sudah melakukan absensi masuk hari ini"
            ]);
        }

        $image = $request->check_in;
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageFix = $this->saveImage($image, "posts");

        $checkIn = Attendance::create([
            'employee_id' => $employee->employee_id,
            'date' => $date,
            'check_in' => $date,
            'image_check_in' => $imageFix,
        ]);

        return redirect('/absensi/landpage');
    }

    public function checkOut(Request $request)
    {
        $data = $request->all();
        $timeNow = Carbon::now();
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();

        $image = $request->check_out;
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageFix = $this->saveImage($image, "posts");

        $hasCheckedIn = Attendance::whereDate('date', $timeNow)
                            ->where('employee_id', $employee->employee_id)
                            ->exists();

        $notCheckOut = Attendance::where('employee_id', $employee->employee_id)
                        ->whereDate('date', $timeNow);

        if(!is_null($notCheckOut->first()->check_out)){
            return response()->json([
                'error' => "Anda sudah melakukan absensi keluar hari ini"
            ]);
        }

        if(!$hasCheckedIn){
            return response()->json([
                'error' => "Anda harus melakukan absensi masuk hari ini"
            ]);
        }

        $checkIn = Attendance::where('id', '=', $request->attendance_id)->update([
            'check_out' => $timeNow,
            'image_check_out' => $imageFix,
            'status' => 'ace'
        ]);

        return redirect('/absensi/landpage');
    }

    public function addLeave(Request $request)
    {
        $data = $request->all();
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
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $leaveData = LeaveApplication::create([
            'employee_id' => $employee->employee_id,
            'leave_type_id' => $data['leave_type_id'],
            'application_from_date' => $data['application_from_date'],
            'application_to_date' => $data['application_to_date'],
            'application_date' => Carbon::now(),
            'purpose' => $data['purpose'],
            'abandoned_job' => $data['abandoned_job'],
        ]);

        return back();
    }

    public function addDuty(Request $request)
    {
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
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
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

        return back();
    }
}
