<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use App\Models\OtherPayment;
use Carbon\Carbon;

class OtherPaymentController extends Controller
{
    public function createTagihan(Request $request)
    {
        try{
            $data = $request->all();

            $validate = Validator::make($data, [
                'event_name' => 'required',
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

            $createTagihan = OtherPayment::create([
                "event_name" => $data['event_name'],
                "total_price" => $data['total_price'],
                "from_date" => $data['from_date'],
                "to_date" => $data['to_date'],
            ]);

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
            $tagihan = OtherPayment::get();

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
            $tagihan = OtherPayment::whereDate('from_date', '<=', $now)
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
