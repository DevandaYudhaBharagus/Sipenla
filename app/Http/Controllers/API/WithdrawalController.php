<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingWithdrawal;
use App\Models\Saving;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Helpers\ResponseFormatter;
use Carbon\Carbon;

class WithdrawalController extends Controller
{
    public function makeWithdrawal(Request $request)
    {
        try{
            $user = Auth::user();
            $code = Str::random(8);
            $fix = strtoupper($code);
            $saldo = Saving::where('user_id', '=', $user->id)->first(['total_amount']);
            if($request->amount >= $saldo->total_amount) return ResponseFormatter::error('Saldo Tidak Mencukupi', 400);

            $withdrawal = SavingWithdrawal::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'saving_code' => $fix,
                'amount' => $request->amount
            ]);

            return ResponseFormatter::success("Succeed added Withdrawal!");
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
            $konfirmasi = SavingWithdrawal::where('saving_withdrawals.status', '=', 'pending')
            ->join('users', 'saving_withdrawals.user_id', 'users.id')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->get([
                "saving_withdrawals.id",
                "first_name",
                "last_name",
                "saving_withdrawals.created_at",
                "amount",
                "saving_code"
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
            $konfirmasi = SavingWithdrawal::where('saving_withdrawals.status', '=', 'pending')
            ->join('users', 'saving_withdrawals.user_id', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->get([
                "saving_withdrawals.id",
                "first_name",
                "last_name",
                "saving_withdrawals.created_at",
                "amount",
                "saving_code"
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

    public function approveWithdrawal($code)
    {
        try{
            $payout = SavingWithdrawal::where('saving_code', '=', $code)->first();
            $saldoLogin = Saving::where('user_id', '=', $payout->user_id)->first();

            $edit = [
                'status' => 'approve'
            ];

            $editSaldo = [
                'total_amount' => $saldoLogin->total_amount - $payout->amount
            ];

            $editPayout = SavingWithdrawal::where('saving_code', '=', $code)->update($edit);
            $editSaldoLogin = Saving::where('user_id', '=', $payout->user_id)->update($editSaldo);

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

    public function rejectWithdrawal($code)
    {
        try{
            $edit = [
                'status' => 'rejected'
            ];

            $updateSaldo = SavingWithdrawal::where('saving_code', '=', $code)->update($edit);

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
            $konfirmasi = SavingWithdrawal::where('saving_withdrawals.status', '=', 'approve')
            ->join('users', 'saving_withdrawals.user_id', 'users.id')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->whereDate('saving_withdrawals.created_at', '=', $tanggal)
            ->get([
                "saving_withdrawals.id",
                "first_name",
                "last_name",
                "saving_withdrawals.created_at",
                "amount",
                "saving_code"
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
            $konfirmasi = SavingWithdrawal::where('saving_withdrawals.status', '=', 'approve')
            ->join('users', 'saving_withdrawals.user_id', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->whereDate('saving_withdrawals.created_at', '=', $tanggal)
            ->get([
                "saving_withdrawals.id",
                "first_name",
                "last_name",
                "saving_withdrawals.created_at",
                "amount",
                "saving_code"
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
}
