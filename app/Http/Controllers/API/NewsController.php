<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Helpers\ResponseFormatter;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function saveImage($image, $path='public')
    {
        try{
            if (!$image) {
                return null;
            }

            $filename = time() . '.png';
            // save image
            Storage::disk($path)->put($filename, base64_decode($image));

            //return the path
            // Url is the base url exp: localhost:8000
            return URL::to('/') . '/storage/' . $path . '/' . $filename;
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getAllNews()
    {
        try{
            $news = News::paginate(3);

            if(is_null($news)){
                return ResponseFormatter::error('Not Found', 404);
            }

            foreach ($news as $n) {
                $test1 = ($n->news_image !== null) ? env('APP_URL') . "/storage/$n->news_image" : '';
                $time = $n->created_at;
                $test2 = ($n->created_at !== null) ? date('d F Y', strtotime($time)) : '';
                $n->news_image = $test1;
                $n->date = $test2;
            }

            $response = [
                $news
            ];

            return ResponseFormatter::success($response, 'Get News Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateNews(Request $request, $id)
    {
        try{
            $image = $this->saveImage($request->news_image, "news");

            $edit = [
                "news_title" => $request->news_title,
                "news_content" => $request->news_content,
                "news_image" => $image,
                "updated_at" => Carbon::now()
            ];


            $updateNews = News::where('news_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('News Has Been Updated');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function deleteNews($id)
    {
        try{
            $deleteNews = News::where('news_id', '=', $id)
                        ->delete();

            return ResponseFormatter::success('News Has Been Deleted');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
