<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaportController extends Controller
{
    public function index(){
        return view('pages.raport.pil-raport');
    }
}
