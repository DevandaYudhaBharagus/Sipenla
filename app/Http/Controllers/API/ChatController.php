<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Room;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function listRoom()
    {
        try{
            $room = Room::orderBy('date', 'desc')->get();

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

    public function listRoomByIdUser()
    {
        try{
            $user = Auth::user();
            $room = Room::where('user_id', '=', $user->id)->first([
                'room_id'
            ]);

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

    public function createChat(Request $request)
    {
        try{
            $user = Auth::user();
            $createChat = Chat::create([
                "user_id" => $user->id,
                "room_id" => $request->room_id,
                "message" => $request->message,
            ]);

            return ResponseFormatter::success("Sukses Chat.");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function readChat($room)
    {
        try{
            $user = Auth::user();
            $chat = Chat::where('room_id', '=', $room)->get();

            foreach ($chat as $b) {
                $test2 = ($b->user_id == $user->id) ? true : false;
                $b->isMe = $test2;
            }

            $response = $chat;

            return ResponseFormatter::success($response, "Sukses Get Chat.");
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function updateChat(Request $request, $room)
    {
        try{
            $edit = [
                'status' => $request->status,
                'date' => Carbon::now(),
                'message' => $request->message
            ];

            $updateRoom = Room::where('room_id', '=', $room)->update($edit);

            return ResponseFormatter::success("Sukses Update Chat.");
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
