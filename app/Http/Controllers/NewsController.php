<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    public function saveImage($image, $path='public')
    {
        if (!$image) {
            return null;
        }

        $filename = time() . '.png';
        // save image
        Storage::disk($path)->put($filename, base64_decode($image));

        //return the path
        // Url is the base url exp: localhost:8000
        $urls = env("AZURE_STORAGE_URL") . env("AZURE_STORAGE_CONTAINER") . "/" . $filename;
        return $urls;
    }

    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('pages.news.news', compact('news'));
    }

    public function show()
    {
        return view('pages.news.create-news');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data,[
            'news_title' => 'required',
            'news_content' => 'required'
        ],
        [
            'news_title.required' => 'Judul Harus Diisi.',
            'news_content.required' => 'Deskripsi Harus Diisi.',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $image = $this->saveImage($request->news_image, "azure");

        $createNews = News::create([
            "news_title" => $request->news_title,
            "news_content" => $request->news_content,
            "category" => 'terpanas',
            "news_image" => $image,
        ]);

        return redirect('/news');
    }

    public function getNewsById($id)
    {
        $news = News::where('news_id', $id)->firstOrFail();
        $datas = News::orderBy('created_at', 'desc')->paginate(2);
        return view('pages.news.detail-news', compact('news', 'datas'));
    }
}
