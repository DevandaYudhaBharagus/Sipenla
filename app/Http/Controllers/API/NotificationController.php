<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Student;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotif()
    {
        try{
            $user = Auth::user();
            if($user->role == 'student'){
                $student = Student::where('user_id', '=', $user->id)->first();
                $notif = Notification::where('student_id', '=', $student->student_id)->get();

                if(!$notif){
                    return ResponseFormatter::success([], "Anda Tidak Memiliki Notif.");
                }

                $response = $notif;

                return ResponseFormatter::success($response, "Succeed Get Tagihan.");
            }else{
                return ResponseFormatter::success([], "Anda Tidak Memiliki Notif.");
            }
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
