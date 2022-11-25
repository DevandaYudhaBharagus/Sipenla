<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{

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
        $createNews = News::create([
            "news_title" => $request->news_title,
            "news_content" => $request->news_content,
            "category" => 'terpanas',
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
