<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Room;

class ChatController extends Controller
{
    public function listRoom()
    {
        try{
            $room = Room::get();

            $response = $room;

            return ResponseFormatter::success($response, "Sukses Get Room.");
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
