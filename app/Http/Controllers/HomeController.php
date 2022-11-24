<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

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
        $user = Auth::user();
        $employee = Student::where('user_id', '=', $user->id)->first();
        if(!$employee){
            return view('pages.dashboard.formulir');
        }
        return view('pages.dashboard.dashboard');
    }

    public function addStudent(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $validate = Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'nik' => 'required|unique:students,nik|size:16',
            'nisn' => 'required|unique:students,nik|size:16',
            'father_name' => 'required',
            'mother_name' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'family_name' => 'required',
            'family_address' => 'required',
            'phone' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'school_origin' => 'required',
            'school_now' => 'required',
            'parent_address' => 'required',
            'mother_profession' => 'required',
            'father_profession' => 'required',
            'mother_education' => 'required',
            'father_education' => 'required',
            'date_school_now' => 'required',
            'family_profession' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $image = $this->saveImage($request->profile_student, "students");

        $studentData = Student::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'nik' => $data['nik'],
            'nisn' => $data['nisn'],
            'mother_name' => $data['mother_name'],
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'religion' => $data['religion'],
            'address' => $data['address'],
            'father_name' => $data['father_name'],
            'family_name' => $data['family_name'],
            'family_address' => $data['family_address'],
            'school_origin' => $data['school_origin'],
            'school_now' => $data['school_now'],
            'parent_address' => $data['parent_address'],
            'mother_profession' => $data['mother_profession'],
            'father_profession' => $data['father_profession'],
            'mother_education' => $data['mother_education'],
            'father_education' => $data['father_education'],
            'date_school_now' => $data['date_school_now'],
            'family_profession' => $data['family_profession'],
            'phone' => $data['phone'],
            'extracurricular_id' => 1,
            'image' => $image,
        ]);

        return redirect('/dashboard');
    }
}
