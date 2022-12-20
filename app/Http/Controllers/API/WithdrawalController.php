<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingWithdrawal;
use App\Models\Saving;
use App\Models\StatusSaving;
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

    public function getSaldoSaving()
    {
        try{
            $user = Auth::user();
            $saldo = Saving::where('user_id', '=', $user->id)->first(['total_amount']);

            $response = $saldo;

            return ResponseFormatter::success($response, 'Success get Saving!');
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

                $history = SavingWithdrawal::where('user_id', '=', $walimurid->user_id)
                ->whereDate('created_at', '=', $tanggal)
                ->get([
                    "amount",
                    "saving_code",
                    "created_at",
                    "status",
                ]);

                $response = $history;

                return ResponseFormatter::success($response, 'Success get history!');
            }
            $history = SavingWithdrawal::where('user_id', '=', $user->id)
            ->whereDate('created_at', '=', $tanggal)
            ->get([
                "amount",
                "saving_code",
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

    public function getStatusSaving()
    {
        try{
            $status = StatusSaving::get();

            $response = $status;

            return ResponseFormatter::success($response, 'Success get Status!');
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try{
            $update = [
                'status_saving' => $request->status
            ];

            $statusUpdate = StatusSaving::where('id', $id)->update($update);

            return ResponseFormatter::success('Success Update Status!');
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
