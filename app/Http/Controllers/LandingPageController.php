<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function getnews(){
        $date = Carbon::now();
        $date->addDays(3);
        $news = News::whereDate('created_at', '>=', $date)->orderBy('created_at', 'desc')->paginate(8);
        $hots = News::whereDate('created_at', '<=', $date)->orderBy('created_at', 'desc')->paginate(2);
        return view('pages.home', compact('news', 'hots'));
    }
}
