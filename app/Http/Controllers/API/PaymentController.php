<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Midtrans\Config;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Helpers\ResponseFormatter;
use App\Models\Transaction;
use App\Models\Employee;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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
        $response = Http::withBasicAuth(Config::$serverKey, "")

        ->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])

        ->get(Config::getBaseUrl() . '/' . $orderID . '/status');

        return json_decode($response->body(), true);
    }
}
