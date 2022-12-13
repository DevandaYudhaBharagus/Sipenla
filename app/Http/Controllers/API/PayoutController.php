<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payout;
use App\Models\Balance;
use App\Models\Guardian;
use App\Helpers\ResponseFormatter;
use Carbon\Carbon;

class PayoutController extends Controller
{
    public function makePayout(Request $request)
    {
        try{
            $user = Auth::user();
            $saldo = Balance::where('user_id', '=', $user->id)->first(['balance']);
            if($request->payout >= $saldo->balance) return ResponseFormatter::error('Saldo Tidak Mencukupi', 400);

            $payout = Payout::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'payout' => $request->payout
            ]);

            return ResponseFormatter::success("Succeed added Payout!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getData()
    {
        try{
            $konfirmasi = Payout::where('status', '=', 'pending')
            ->join('users', 'payouts.user_id', 'users.id')
            ->get([
                "role"
            ]);

            foreach($konfirmasi as $k){
                if($k->role == 'student'){
                    $name = Payout::where('status', '=', 'pending')
                            ->join('users', 'payouts.user_id', 'users.id')
                            ->join('students', 'users.id', '=', 'students.user_id')
                            ->get([
                                "payouts.id",
                                "first_name",
                                "last_name",
                                "payouts.created_at",
                                "payout"
                            ]);
                }else{
                    $name = Payout::where('status', '=', 'pending')
                            ->join('users', 'payouts.user_id', 'users.id')
                            ->join('employees', 'users.id', '=', 'employees.user_id')
                            ->get([
                                "payouts.id",
                                "first_name",
                                "last_name",
                                "payouts.created_at",
                                "payout"
                            ]);
                }
            }

            foreach ($name as $n) {
                $time = $n->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $n->waktu = $test2;
            }

            $response = $name;

            return ResponseFormatter::success($response, "Succeed get Payout!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function approvePayout($id)
    {
        try{
            $payout = Payout::where('id', '=', $id)->first();
            $saldoLogin = Balance::where('user_id', '=', $payout->user_id)->first();

            $edit = [
                'status' => 'approve'
            ];

            $editSaldo = [
                'balance' => $saldoLogin->balance - $payout->payout
            ];

            $editPayout = Payout::where('id', '=', $id)->update($edit);
            $editSaldoLogin = Balance::where('user_id', '=', $payout->user_id)->update($editSaldo);

            return ResponseFormatter::success("Succeed approve Payout!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function rejectPayout($id)
    {
        try{
            $edit = [
                'status' => 'rejected'
            ];

            $updateSaldo = Payout::where('id', '=', $id)->update($edit);

            return ResponseFormatter::success('Success rejected payout!');
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getHistoryConfirm($tanggal)
    {
        try{
            $konfirmasi = Payout::where('status', '=', 'pending')
            ->join('users', 'payouts.user_id', 'users.id')
            ->whereDate('payouts.created_at', '=', $tanggal)
            ->get([
                "role"
            ]);

            foreach($konfirmasi as $k){
                if($k->role == 'student'){
                    $name = Payout::where('status', '=', 'pending')
                            ->join('users', 'payouts.user_id', 'users.id')
                            ->join('students', 'users.id', '=', 'students.user_id')
                            ->whereDate('payouts.created_at', '=', $tanggal)
                            ->get([
                                "payouts.id",
                                "first_name",
                                "last_name",
                                "payouts.created_at",
                                "payout"
                            ]);
                }else{
                    $name = Payout::where('status', '=', 'pending')
                            ->join('users', 'payouts.user_id', 'users.id')
                            ->join('employees', 'users.id', '=', 'employees.user_id')
                            ->whereDate('payouts.created_at', '=', $tanggal)
                            ->get([
                                "payouts.id",
                                "first_name",
                                "last_name",
                                "payouts.created_at",
                                "payout"
                            ]);
                }
            }

            foreach ($name as $n) {
                $time = $n->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $n->waktu = $test2;
            }

            $response = $name;

            return ResponseFormatter::success($response, "Succeed get Payout!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getHistory($tanggal)
    {
        try{
            $user = Auth::user();
            if($user->role == 'walimurid'){
                $walimurid = Guardian::join('students', 'student_guardians.student_id', '=', 'students.student_id')
                            ->where('student_guardians.user_id', '=', $user->id)
                            ->first(['students.user_id']);

                $history = Payout::where('user_id', '=', $walimurid->user_id)
                ->whereDate('created_at', '=', $tanggal)
                ->get([
                    "payout",
                    "created_at",
                    "status",
                ]);

                $response = $history;

                return ResponseFormatter::success($response, 'Success get history!');
            }
            $history = Payout::where('user_id', '=', $user->id)
            ->whereDate('created_at', '=', $tanggal)
            ->get([
                "payout",
                "created_at",
                "status",
            ]);

            foreach ($history as $h) {
                $time = $h->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $h->waktu = $test2;
            }

            $response = $history;

            return ResponseFormatter::success($response, 'Success get history!');
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
