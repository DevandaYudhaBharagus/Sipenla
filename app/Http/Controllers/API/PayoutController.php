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
use Illuminate\Support\Str;

class PayoutController extends Controller
{
    public function makePayout(Request $request)
    {
        try{
            $user = Auth::user();
            $code = Str::random(8);
            $fix = strtoupper($code);
            $saldo = Balance::where('user_id', '=', $user->id)->first(['balance']);
            if($request->payout >= $saldo->balance) return ResponseFormatter::error('Saldo Tidak Mencukupi', 400);

            $payout = Payout::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'payout_code' => $fix,
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

    public function getDataSiswa()
    {
        try{
            $konfirmasi = Payout::where('payouts.status', '=', 'pending')
            ->join('users', 'payouts.user_id', 'users.id')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->get([
                "payouts.id",
                "first_name",
                "last_name",
                "payouts.created_at",
                "payout",
                "payout_code"
            ]);

            foreach ($konfirmasi as $k) {
                $time = $k->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $k->waktu = $test2;
            }

            $response = $konfirmasi;

            return ResponseFormatter::success($response, "Succeed get data!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getDataPegawai()
    {
        try{
            $konfirmasi = Payout::where('payouts.status', '=', 'pending')
            ->join('users', 'payouts.user_id', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->get([
                "payouts.id",
                "first_name",
                "last_name",
                "payouts.created_at",
                "payout",
                "payout_code"
            ]);

            foreach ($konfirmasi as $k) {
                $time = $k->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $k->waktu = $test2;
            }

            $response = $konfirmasi;

            return ResponseFormatter::success($response, "Succeed get data!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function approvePayout($code)
    {
        try{
            $payout = Payout::where('payout_code', '=', $code)->first();
            $saldoLogin = Balance::where('user_id', '=', $payout->user_id)->first();

            $edit = [
                'status' => 'approve'
            ];

            $editSaldo = [
                'balance' => $saldoLogin->balance - $payout->payout
            ];

            $editPayout = Payout::where('payout_code', '=', $code)->update($edit);
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

    public function rejectPayout($code)
    {
        try{
            $edit = [
                'status' => 'rejected'
            ];

            $updateSaldo = Payout::where('payout_code', '=', $code)->update($edit);

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

    public function getHistorySiswa($tanggal)
    {
        try{
            $konfirmasi = Payout::where('payouts.status', '=', 'approve')
            ->join('users', 'payouts.user_id', 'users.id')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->whereDate('payouts.created_at', '=', $tanggal)
            ->get([
                "payouts.id",
                "first_name",
                "last_name",
                "payouts.created_at",
                "payout",
                "payout_code"
            ]);

            foreach ($konfirmasi as $k) {
                $time = $k->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $k->waktu = $test2;
            }

            $response = $konfirmasi;

            return ResponseFormatter::success($response, "Succeed get Hitory!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getHistoryPegawai($tanggal)
    {
        try{
            $konfirmasi = Payout::where('payouts.status', '=', 'approve')
            ->join('users', 'payouts.user_id', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->whereDate('payouts.created_at', '=', $tanggal)
            ->get([
                "payouts.id",
                "first_name",
                "last_name",
                "payouts.created_at",
                "payout",
                "payout_code"
            ]);

            foreach ($konfirmasi as $k) {
                $time = $k->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $k->waktu = $test2;
            }

            $response = $konfirmasi;

            return ResponseFormatter::success($response, "Succeed get Hitory!");
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
                    "payout_code",
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
                "payout_code",
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
