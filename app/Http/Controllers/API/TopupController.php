<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BalanceCode;
use App\Models\Balance;
use App\Models\Guardian;
use Illuminate\Support\Str;
use App\Helpers\ResponseFormatter;
use Carbon\Carbon;

class TopupController extends Controller
{
    public function updateSaldo(Request $request)
    {
        try{
            $user = Auth::user();
            $code = Str::random(8);
            $fix = strtoupper($code);
            $balance = BalanceCode::create([
                'user_id' => $user->id,
                'balance_code' => $fix,
                'status' => 'pending',
                'balance' => $request->balance
            ]);

            $response = [
                "balance" => $balance->balance,
                "balance_code" => $balance->balance_code,
                "expire" => Carbon::parse($balance->created_at)->addHours(2)->format('d F, H.i')
            ];

            return ResponseFormatter::success($response, "Succeed added Balance!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function checkCode(Request $request)
    {
        try{
            $token = $request->only('code');

            $request->validate([
                'code' => 'required'
            ]);

            $code = BalanceCode::where(['balance_code' => $token])
                    ->join('users', 'balance_codes.user_id', '=', 'users.id')->first();

            if(!$code) return ResponseFormatter::error('Invalid Token', 400);

            if($code->role == 'student'){
                $student = BalanceCode::where(['balance_code' => $token])
                    ->join('users', 'balance_codes.user_id', '=', 'users.id')
                    ->join('students', 'users.id', '=', 'students.user_id')->first([
                        "first_name",
                        "last_name",
                        "balance_code",
                        "balance",
                        "balance_codes.created_at",
                    ]);

                $time = $student->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $student->waktu = $test2;

                $response = [
                    $student
                ];
                return ResponseFormatter::success($response, 'Get Code Success');
            }else{
                $employee = BalanceCode::where(['balance_code' => $token])
                    ->join('users', 'balance_codes.user_id', '=', 'users.id')
                    ->join('employees', 'users.id', '=', 'employees.user_id')->first([
                        "first_name",
                        "last_name",
                        "balance_code",
                        "balance",
                        "balance_codes.created_at",
                    ]);

                $time = $employee->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $employee->waktu = $test2;

                $response = $employee;
                return ResponseFormatter::success($response, 'Get Code Success');
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

    public function approveSaldo($code)
    {
        try{
            $userLogin = Auth::user();
            $edit = [
                'status' => 'approve'
            ];

            $saldo = BalanceCode::where('balance_code', '=', $code)->first();
            $saldoLogin = Balance::where('user_id', '=', $userLogin->id)->first();
            $saldoUser = Balance::where('user_id', '=', $saldo->user_id)->first();
            if($saldoLogin->balance <= 0) return ResponseFormatter::error('Saldo Tidak Mencukupi', 400);

            $updateSaldo = BalanceCode::where('balance_code', '=', $code)->update($edit);

            $editBalance = [
                'balance' => $saldoUser->balance + $saldo->balance
            ];

            $user = Balance::where('user_id', '=', $saldo->user_id)
                    ->update($editBalance);

            $editLogin= [
                'balance' => $saldoLogin->balance - $saldo->balance
            ];

            $login = Balance::where('user_id', '=', $userLogin->id)
                    ->update($editLogin);

            return ResponseFormatter::success('Success confirm balance!');
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function rejectSaldo($code)
    {
        try{
            $edit = [
                'status' => 'rejected'
            ];

            $updateSaldo = BalanceCode::where('balance_code', '=', $code)->update($edit);

            return ResponseFormatter::success('Success rejected balance!');
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getSaldoUser()
    {
        try{
            $user = Auth::user();
            $saldo = Balance::where('user_id', '=', $user->id)->first(['balance']);

            $response = $saldo;

            return ResponseFormatter::success($response, 'Success get balance!');
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

                $history = BalanceCode::where('user_id', '=', $walimurid->user_id)
                ->whereDate('created_at', '=', $tanggal)
                ->get([
                    "balance_code",
                    "balance",
                    "created_at",
                    "status",
                ]);

                $response = $history;

                return ResponseFormatter::success($response, 'Success get history!');
            }
            $history = BalanceCode::where('user_id', '=', $user->id)
            ->whereDate('created_at', '=', $tanggal)
            ->get([
                "balance_code",
                "balance",
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

    public function getDataSiswa($tanggal)
    {
        try{
            $konfirmasi = BalanceCode::where('balance_codes.status', '=', 'approve')
            ->join('users', 'balance_codes.user_id', 'users.id')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->whereDate('balance_codes.created_at', '=', $tanggal)
            ->get([
                "balance_codes.id",
                "first_name",
                "last_name",
                "balance_codes.created_at",
                "balance",
                "balance_code"
            ]);

            foreach ($konfirmasi as $k) {
                $time = $k->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $k->waktu = $test2;
            }

            $response = $konfirmasi;

            return ResponseFormatter::success($response, "Succeed get Hitory Isi Saldo!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getDataPegawai($tanggal)
    {
        try{
            $konfirmasi = BalanceCode::where('balance_codes.status', '=', 'approve')
            ->join('users', 'balance_codes.user_id', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->whereDate('balance_codes.created_at', '=', $tanggal)
            ->get([
                "balance_codes.id",
                "first_name",
                "last_name",
                "balance_codes.created_at",
                "balance",
                "balance_code"
            ]);

            foreach ($konfirmasi as $k) {
                $time = $k->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $k->waktu = $test2;
            }

            $response = $konfirmasi;

            return ResponseFormatter::success($response, "Succeed get Hitory Isi Saldo!");
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
