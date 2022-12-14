<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FineTransaction;
use Carbon\Carbon;
use App\Helpers\ResponseFormatter;

class FineController extends Controller
{
    public function getHistory($tanggal)
    {
        try{
            $user = Auth::user();
            $history = FineTransaction::where('user_id', '=', $user->id)
            ->whereDate('created_at', '=', $tanggal)
            ->get([
                "fine_transaction_code",
                "fine_transaction",
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
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
