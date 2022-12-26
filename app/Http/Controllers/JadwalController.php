<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(){
        return view('pages.jadwal.jadwal');
    }
    public function jadwalkerja(){
        return view('pages.jadwal.jadwal-shift-kerja', );
    }
}
