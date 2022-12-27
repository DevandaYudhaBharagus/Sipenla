<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Balance;
use App\Helpers\ResponseFormatter;
use App\Models\Kantin;
use App\Models\KantinTransaction;
use App\Models\Employee;
use Carbon\Carbon;

class KantinController extends Controller
{
    public function createKantin(Request $request)
    {
        try{
            $code = Str::random(8);
            $fix = strtoupper($code);
            $kantin = Kantin::create([
                "kode_kantin" => $fix,
                "nama_kantin" => $request->nama_kantin,
                "employee_id" => $request->employee_id,
            ]);

            return ResponseFormatter::success("Succeed Create Kantin!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getPegawai()
    {
        try{
            $pegawai = Employee::join('users', 'employees.user_id', '=', 'users.id')
                        ->where('role', '=', 'pegawaikantin')
                        ->get([
                            "employee_id",
                            "first_name",
                            "last_name"
                        ]);

            $response = $pegawai;

            return ResponseFormatter::success($response, "Succeed Get Pegawai Kantin!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getScan($kode)
    {
        try{
            $kantin = Kantin::where('kode_kantin', '=', $kode)
                        ->first();

            $response = $kantin;

            return ResponseFormatter::success($response, "Succeed Get Pegawai Kantin!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getKantin()
    {
        try{
            $kantin = Kantin::join('employees', 'kantins.employee_id', '=', 'employees.employee_id')
                        ->get([
                            "kantins.id",
                            "nama_kantin",
                            "kode_kantin",
                            "first_name",
                            "last_name",
                        ]);

            $response = $kantin;

            return ResponseFormatter::success($response, "Succeed Get Kantin!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function createTransaction(Request $request, $employee_id)
    {
        try{
            $user = Auth::user();
            $code = Str::random(8);
            $fix = strtoupper($code);
            $saldoLogin = Balance::where('user_id', '=', $user->id)->first();
            $kantin = Kantin::join('employees', 'kantins.employee_id', '=', 'employees.employee_id')
                    ->where('kantins.employee_id', '=', $employee_id)
                    ->first();
            $balance = Balance::where('user_id', '=', $kantin->user_id)->first(['balance']);
            if($saldoLogin->balance < $request->price) return ResponseFormatter::error('Saldo Tidak Mencukupi', 400);
            $transaction = KantinTransaction::create([
                "user_id" =>$user->id,
                "price" =>$request->price,
                "code_transaction" =>$fix,
                "date" =>Carbon::now(),
            ]);

            $edit = [
                'balance' => $saldoLogin->balance - $request->price
            ];

            $editBalance = [
                'balance' => $balance->balance + $request->price
            ];

            $login = Balance::where('user_id', '=', $user->id)
                    ->update($edit);

            $saldoKantin = Balance::where('user_id', '=', $kantin->user_id)
                    ->update($editBalance);

            return ResponseFormatter::success("Succeed Create Kantin!");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getHistoryByUser()
    {
        try{
            $user = Auth::user();
            $history = KantinTransaction::where('user_id', '=', $user->id)->get();

            $response = $history;

            return ResponseFormatter::success($response, "Succeed Get History!");
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
