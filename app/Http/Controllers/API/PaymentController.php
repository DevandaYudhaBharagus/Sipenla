<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Midtrans\Config;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Helpers\ResponseFormatter;
use App\Models\Transaction;
use App\Models\Employee;
use App\Models\Balance;
use App\Models\Saving;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->serverKey = config('midtrans.serverKey');
    }

    public function testPayment(Request $request)
    {
        try{
            $user = Auth::user();
            if($user->role == 'student'){
                $student = Student::where('user_id', '=', $user->id)->first();
                $code = Str::random(8);
                $createTransaction = Transaction::create([
                    "item_name" => $request->item_name,
                    "user_id" => $user->id,
                    "order_id" => $code."-". $request->item_name,
                    "gross_amount" => $request->gross_amount,
                    "status" => "pending",
                ]);
                $transaction = array(
                    "payment_type" => "bank_transfer",
                    "transaction_details" => [
                        "gross_amount" => $request->gross_amount,
                        "order_id" => $code."-". $request->item_name
                    ],
                    "customer_details" => [
                        "email" => $user->email,
                        "first_name" => $student->first_name,
                        "last_name" => $student->last_name,
                        "phone" => $student->phone
                    ],
                    "item_details" => array([
                        "id" => "item01",
                        "price" => $request->gross_amount,
                        "quantity" => 1,
                        "name" => $request->item_name
                    ]),
                    "bank_transfer" => [
                        "bank" => "bca",
                        "va_number" => "12345678901",
                    ],
                );

                $charge = CoreApi::charge($transaction);
                if(!$charge){
                    return ResponseFormatter::error('Gagal, Terjadi Kesalahan', 400);
                }
                $response = $charge;

                return ResponseFormatter::success($response, 'Success Payment');
            }

            $employee = Employee::where('user_id', '=', $user->id)->first();
            $code = Str::random(8);
            $createTransaction = Transaction::create([
                "item_name" => $request->item_name,
                "user_id" => $user->id,
                "order_id" => $code."-". $request->item_name,
                "gross_amount" => $request->gross_amount,
                "status" => "pending",
            ]);
            $transaction = array(
                "payment_type" => "bank_transfer",
                "transaction_details" => [
                    "gross_amount" => $request->gross_amount,
                    "order_id" => $code."-". $request->item_name
                ],
                "customer_details" => [
                    "email" => $user->email,
                    "first_name" => $employee->first_name,
                    "last_name" => $employee->last_name,
                    "phone" => $employee->phone
                ],
                "item_details" => array([
                    "id" => "item01",
                    "price" => $request->gross_amount,
                    "quantity" => 1,
                    "name" => $request->item_name
                ]),
                "bank_transfer" => [
                    "bank" => "bca",
                    "va_number" => "12345678901",
                ],
            );

            $charge = CoreApi::charge($transaction);
            if(!$charge){
                return ResponseFormatter::error('Gagal, Terjadi Kesalahan', 400);
            }
            $response = $charge;

            return ResponseFormatter::success($response, 'Success Payment');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getStatus($orderID)
    {
        try{
            $response = Http::withBasicAuth(Config::$serverKey, "")

            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])

            ->get(Config::getBaseUrl() . '/' . $orderID . '/status');

            return json_decode($response->body(), true);
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateBalance(Request $request)
    {
        try{
            $user = Auth::user();
            $balance = Balance::where('user_id', '=', $user->id)->first("balance");

            $editBalance = [
                'balance' => $balance->balance + $request->saldo
            ];

            $login = Balance::where('user_id', '=', $user->id)
                    ->update($editBalance);

            return ResponseFormatter::success('Success confirm balance!');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateStatus($orderid)
    {
        try{
            $editStatus = [
                'status' => 'approve'
            ];

            $transaction = Transaction::where('order_id', '=', $orderid)->update($editStatus);

            return ResponseFormatter::success('Success confirm balance!');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateSaving(Request $request)
    {
        try{
            $user = Auth::user();
            $saving = Saving::where('user_id', '=', $user->id)->first("total_amount");

            $editBalance = [
                'total_amount' => $saving->total_amount + $request->saldo
            ];

            $login = Saving::where('user_id', '=', $user->id)
                    ->update($editBalance);

            return ResponseFormatter::success('Success confirm balance!');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryTopup($tanggal)
    {
        try{
            $user = Auth::user();
            $transaction = Transaction::where('item_name', '=', 'TOPUP')
            ->whereDate('created_at', '=', $tanggal)
            ->where('user_id', '=', $user->id)
            ->get();

            foreach ($transaction as $h) {
                $time = $h->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $h->waktu = $test2;
            }

            $response = $transaction;

            return ResponseFormatter::success($response, 'Success get Transaksi!');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistorySaving($tanggal)
    {
        try{
            $user = Auth::user();
            if($user->role == 'walimurid'){
                $walmur = Guardian::where('student_guardians.user_id', '=', $user->id)
                ->join('students', 'student_guardians.student_id', '=', 'students.student_id')
                ->first([
                    "students.student_id"
                ]);
                $transaction = Transaction::where('item_name', '=', 'TABUNGAN')
                    ->whereDate('created_at', '=', $tanggal)
                    ->where('transactions.user_id', '=', $walmur->student_id)
                    ->get();

                    foreach ($transaction as $h) {
                        $time = $h->created_at;
                        $test2 = Carbon::parse($time)->format('d F, H.i');
                        $h->waktu = $test2;
                    }

                    $response = $transaction;

                    return ResponseFormatter::success($response, 'Success get Transaksi!');
            }
            $transaction = Transaction::where('item_name', '=', 'TABUNGAN')
            ->whereDate('created_at', '=', $tanggal)
            ->where('user_id', '=', $user->id)
            ->get();

            foreach ($transaction as $h) {
                $time = $h->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $h->waktu = $test2;
            }

            $response = $transaction;

            return ResponseFormatter::success($response, 'Success get Transaksi!');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryOtherPayment($tanggal)
    {
        try{
            $user = Auth::user();
            if($user->role == 'walimurid'){
                $walmur = Guardian::where('student_guardians.user_id', '=', $user->id)
                ->join('students', 'student_guardians.student_id', '=', 'students.student_id')
                ->first([
                    "students.student_id"
                ]);
                $transaction = Transaction::where('item_name', '=', 'ADM-LAIN')
                    ->whereDate('created_at', '=', $tanggal)
                    ->where('transactions.user_id', '=', $walmur->student_id)
                    ->get();

                    foreach ($transaction as $h) {
                        $time = $h->created_at;
                        $test2 = Carbon::parse($time)->format('d F, H.i');
                        $h->waktu = $test2;
                    }

                    $response = $transaction;

                    return ResponseFormatter::success($response, 'Success get Transaksi!');
            }
            $transaction = Transaction::where('item_name', '=', 'ADM-LAIN')
            ->whereDate('created_at', '=', $tanggal)
            ->where('user_id', '=', $user->id)
            ->get();

            foreach ($transaction as $h) {
                $time = $h->created_at;
                $test2 = Carbon::parse($time)->format('d F, H.i');
                $h->waktu = $test2;
            }

            $response = $transaction;

            return ResponseFormatter::success($response, 'Success get Transaksi!');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
