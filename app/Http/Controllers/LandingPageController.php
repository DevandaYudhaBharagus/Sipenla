<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function getnews(){
        $news = News::orderBy('created_at', 'desc')->paginate(8);
        return view('pages.home', compact('news'));
    }
}
