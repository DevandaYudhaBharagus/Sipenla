<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use Illuminate\Support\Facades\Validator;

class LessonSchedulesController extends Controller
{
    public function index(){
        $days = Day::whereNotIn('day_name' ,['Semua'])->get();
        $grades = Grade::all();
        $subject = Subject::all();
        $teachers = Employee::join('users','employees.user_id', '=', 'users.id')
        ->join('workshifts','employees.workshift_id','=','workshifts.workshift_id')
        ->where('role' ,'=','guru')->get();

        $schedule = LessonSchedule::join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                ->join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                ->join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                ->get();

        return view('pages.master.master-jadwal', compact('days','grades','subject','teachers','schedule'));


    }

    public function store(Request $request){
        $data = $request->all();
        $validate = Validator::make($data,[
                'days_id' => 'required',
                'grade_id' => 'required',
                'subject_id' => 'required',
                'teacher_id' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ],
            [
                'days_id.required' => 'Hari Harus Diisi.',
                'grade_id.required' => 'Kelas Harus Diisi.',
                'subject_id.required' => 'Mata Pelajaran Harus Diisi.',
                'teacher_id.required' => 'Guru Kedatangan Harus Diisi.',
                'start_time.required' => 'Waktu Awal Harus Diisi.',
                'end_time.required' => 'Waktu Akhir Kedatangan Harus Diisi.',
            ]
        );

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $CreateLessonSchedule = LessonSchedule::create([
            'days_id' => $data['days_id'],
            'grade_id' => $data['grade_id'],
            'subject_id' => $data['subject_id'],
            'teacher_id' => $data['teacher_id'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'], 
        ]);

        return redirect('/schedules');
    }

    public function delete($id){
        $ekstra = LessonSchedule::where('lesson_schedule_id', $id);
        $ekstra->delete();
        return redirect('/schedules');
    }

    
}