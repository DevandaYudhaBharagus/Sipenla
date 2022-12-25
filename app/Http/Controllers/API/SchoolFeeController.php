<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use App\Models\SchoolFee;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SchoolFeeController extends Controller
{
    public function createTagihan(Request $request)
    {
        try{
            $data = $request->all();
            $user = User::where('role', '=', 'student')->join('students', 'users.id', 'students.user_id')->get();

            $validate = Validator::make($data, [
                'mount' => 'required',
                'total_price' => 'required',
                'from_date' => 'required',
                'to_date' => 'required|after:from_date'
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $createTagihan = SchoolFee::create([
                "mount" => $data['mount'],
                "total_price" => $data['total_price'],
                "from_date" => $data['from_date'],
                "to_date" => $data['to_date'],
            ]);

            $start = Carbon::parse($data['from_date']);
            $end = Carbon::parse($data['to_date']);
            $start->settings(['formatFunction' => 'translatedFormat']);
            $end->settings(['formatFunction' => 'translatedFormat']);

            foreach($user as $s){
                $notification = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('ONESIGNAL_REST_API_KEY')
                ])->post(env('ONESIGNAL_URL'), [
                    'app_id' => env('ONESIGNAL_APP_ID'),
                    'android_channel_id' => env('ONESIGNAL_ANDROID_CHANNEL_ID'),
                    'small_icon' => "ic_stat_onesignal_default",
                    'include_external_user_ids' => [$s->email],
                    'channel_for_external_user_ids' => "push",
                    'headings' => ["en" => "SPP"],
                    'contents' => ["en" => $s->first_name . " " . $s->last_name . " Jangan Lupa Membayar SPP dari Tanggal". " ". $start->format('d F Y'). " ". "Sampai Tanggal". " ". $end->format('d F Y')]
                ]);

                $createNotif = Notification::create([
                    'student_id' => $s->student_id,
                    'title' => 'Peringatan Pembayaran SPP bulan'. ' '. $start->format('F'). ' '. $s->first_name . " " . $s->last_name ,
                    'notif_type' => 'SPP',
                    'message' => $s->first_name . " " . $s->last_name . " Jangan Lupa Membayar SPP dari Tanggal". " ". $start->format('d F Y'). " ". "Sampai Tanggal". " ". $end->format('d F Y'),
                    'send_time' => Carbon::now(),
                ]);
            }

            return ResponseFormatter::success( "Succeed to added Tagihan.");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getTagihan()
    {
        try{
            $tagihan = SchoolFee::get();

            $response = $tagihan;

            return ResponseFormatter::success($response, "Succeed Get Tagihan.");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getTagihanByDate()
    {
        try{
            $now = Carbon::now();
            $tagihan = SchoolFee::whereDate('from_date', '<=', $now)
                        ->whereDate('to_date', '>=', $now)
                        ->get();

            $response = $tagihan;

            return ResponseFormatter::success($response, "Succeed Get Tagihan.");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }
}
