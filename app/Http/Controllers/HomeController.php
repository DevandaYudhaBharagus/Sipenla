<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Balance;
use App\Models\Room;
use App\Models\Saving;
use App\Models\Workshift;
use App\Models\Extracurricular;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
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
        if($user->role == "student"){
            $student = Student::where('user_id', '=', $user->id)->first();
            if(!$student){
                $ekstra = Extracurricular::get();
                return view('pages.dashboard.formulir', compact('ekstra'));
            }
            $timeNow = Carbon::now();
            $day = Carbon::parse($timeNow);
            $day->settings(['formatFunction' => 'translatedFormat']);
            $schedule = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                                    ->join('student_grades', 'lesson_schedules.grade_id', '=', 'student_grades.grade_id')
                                    ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                                    ->Join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                                    ->where('day_name', '=', $day->format('l'))
                                    ->where('student_id', '=', $student->student_id)
                                    ->get();

            $news = News::orderBy('created_at', 'desc')->get();

            return view('pages.dashboard.dashboard', compact('student','schedule','news'));
        }
        $employee = Employee::where('user_id', '=', $user->id)->first();
        if(!$employee){
            $workshift = Workshift::get();
            return view('pages.dashboard.formulir-pegawai', compact('workshift'));
        }
        $timeNow = Carbon::now();
        $day = Carbon::parse($timeNow);
        $day->settings(['formatFunction' => 'translatedFormat']);
        $schedule = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                                ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                                ->Join('grades', 'lesson_schedules.teacher_id', '=', 'grades.teacher_id')
                                ->where('day_name', '=', $day->format('l'))
                                ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                                ->get();

                            // dd($schedule);
        $news = News::orderBy('created_at', 'desc')->paginate(5);

        return view('pages.dashboard.dashboard', compact('employee','schedule','news'));

    }

    public function addStudent(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $validate = Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'nisn' => 'required|unique:students,nisn|size:16',
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

        $imageEncoded = base64_encode(file_get_contents($request->file('profile_student')->path()));

        $imageFix = $this->saveImage($imageEncoded, "azure");

        $studentData = Student::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
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
            'extracurricular_id' => $data['extracurricular_id'],
            'image' => $imageFix,
        ]);

        $balance = Balance::create([
            'user_id' => $user->id,
            'total_balance' => 0
        ]);

        $saving = Saving::create([
            'user_id' => $user->id,
            'total_amount' => 0
        ]);

        $chat = Room::create([
            'user_id' => $user->id,
            'admin_id' => 1,
            'name_room' => $studentData['first_name']. ' '. $studentData['last_name'],
            'image_profile' => $imageFix,
            'status' => 'tidak',
            'date' => Carbon::now(),
            'message' => ""
        ]);

        return redirect('/dashboard');
    }

    public function addEmployee(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $validate = Validator::make($data, [
            'first_name' => 'required',
            'last_name' => 'required',
            'nuptk' => 'required|unique:employees,nuptk|size:16',
            'npsn' => 'required|unique:employees,npsn|size:16',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'education' => 'required',
            'family_name' => 'required',
            'family_address' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'workshift_id' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $imageEncoded = base64_encode(file_get_contents($request->file('profile_employee')->path()));

        $imageFix = $this->saveImage($imageEncoded, "azure");

        $employeeData = Employee::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'nuptk' => $data['nuptk'],
            'npsn' => $data['npsn'],
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'religion' => $data['religion'],
            'address' => $data['address'],
            'education' => $data['education'],
            'family_name' => $data['family_name'],
            'family_address' => $data['family_address'],
            'position' => $data['position'],
            'phone' => $data['phone'],
            'company_id' => 1,
            'workshift_id' => $data['workshift_id'],
            "image" => $imageFix,
        ]);

        $leaveBalance = LeaveBalance::create([
            'employee_id' => $employeeData['employee_id'],
            'total_balance' => 12
        ]);

        $balance = Balance::create([
            'user_id' => $user->id,
            'total_balance' => 0
        ]);

        $saving = Saving::create([
            'user_id' => $user->id,
            'total_amount' => 0
        ]);

        $chat = Room::create([
            'user_id' => $user->id,
            'admin_id' => 1,
            'name_room' => $employeeData['first_name']. ' '. $employeeData['last_name'],
            'image_profile' => $imageFix,
            'status' => 'tidak',
            'date' => Carbon::now(),
            'message' => ""
        ]);

        return redirect('/dashboard');
    }
}
