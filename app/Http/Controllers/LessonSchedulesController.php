<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Employee;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\LessonSchedule;
use App\Models\Extracurricular;
use App\Models\ExtraSchedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
                'end_time' => 'required|after:start_time',
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

        $lesson = LessonSchedule::where('subject_id', '=', $data['subject_id'])
                ->where('teacher_id', '=', $data['teacher_id'])
                ->where('grade_id', '=', $data['grade_id']);

        if($lesson->exists()){
            return response()->json([
                "error" => "Jadwal Telah tersedia!"
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

        return response()->json([
            "error" => false,
            "message" => "Successfuly Added Shift Data!"
        ]);
    }

    public function edit($id)
    {
        $where = array('lesson_schedule_id' => $id);
        $post  = LessonSchedule::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = LessonSchedule::where('lesson_schedule_id', $id);
        $student->update($data);
    }

    public function delete($id){
        try {
            LessonSchedule::where('lesson_schedule_id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Sukses Menghapus Data Jadwal Mata Pelajaran!"]);
    }



    //Ekstrakurikuler
    public function schedulesEkstrakurikuler(){
        $days = Day::whereNotIn('day_name' ,['Semua','Sabtu','Minggu'])->get();
        $ekstras = Extracurricular::all();
        $teachers = Employee::join('users','employees.user_id', '=', 'users.id')
                            ->join('workshifts','employees.workshift_id','=','workshifts.workshift_id')
                            ->where('role' ,'=','guru')->get();

        $schedule = ExtraSchedule::join('days', 'extra_schedules.days_id', '=', 'days.day_id')
                ->join('extracurriculars', 'extra_schedules.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                ->join('employees', 'extra_schedules.teacher_id', '=', 'employees.employee_id')
                ->get();
        return view('pages.master.master-jadwal-ekstra',compact('days','ekstras','teachers','schedule'));
    }

    public function storeExtra(Request $request){
        $data = $request->all();
        $validate = Validator::make($data,[
                'days_id' => 'required',
                'extracurricular_id' => 'required',
                'teacher_id' => 'required',
                'start_time' => 'required',
                'end_time' => 'required|after:start_time',
            ],
            [
                'days_id.required' => 'Hari Harus Diisi.',
                'extracurricular_id.required' => 'Mata Pelajaran Harus Diisi.',
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

        $CreateLessonSchedule = ExtraSchedule::create([
            'days_id' => $data['days_id'],
            'extracurricular_id' => $data['extracurricular_id'],
            'teacher_id' => $data['teacher_id'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        ]);

        return response()->json([
            "error" => false,
            "message" => "Successfuly Added Shift Data!"
        ]);
    }

    public function delSchedulesEkstrakurikuler($id){
        try {
            ExtraSchedule::where('extra_schedules_id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Sukses Menghapus Data Jadwal Ekstra!"]);
    }

    public function editSchedulesEkstrakurikuler($id){
        $where = array('extra_schedules_id' => $id);
        $post  = ExtraSchedule::where($where)->first();

        return response()->json($post);
    }

    public function updateExtra(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = ExtraSchedule::where('extra_schedules_id', $id);
        $student->update($data);
    }

    public function getScheduleByUser()
    {
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
        $senin = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                                ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                                ->Join('grades', 'lesson_schedules.teacher_id', '=', 'grades.teacher_id')
                                ->where('day_name', '=', 'senin')
                                ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                                ->get();

        $selasa = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                                ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                                ->Join('grades', 'lesson_schedules.teacher_id', '=', 'grades.teacher_id')
                                ->where('day_name', '=', 'selasa')
                                ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                                ->get();

        $rabu = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                                ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                                ->Join('grades', 'lesson_schedules.teacher_id', '=', 'grades.teacher_id')
                                ->where('day_name', '=', 'rabu')
                                ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                                ->get();

        $kamis = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                                ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                                ->Join('grades', 'lesson_schedules.teacher_id', '=', 'grades.teacher_id')
                                ->where('day_name', '=', 'kamis')
                                ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                                ->get();

        $jumat = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                                ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                                ->Join('grades', 'lesson_schedules.teacher_id', '=', 'grades.teacher_id')
                                ->where('day_name', '=', 'jumat')
                                ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                                ->get();

        return view('pages.jadwal.jadwal-mapel-guru',compact('senin', 'selasa', 'rabu', 'kamis', 'jumat'));
    }

    public function getScheduleByStudent()
    {
        $user = Auth::user();
        $student = Student::where('user_id', '=', $user->id)->first();
        $senin = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                    ->join('student_grades', 'lesson_schedules.grade_id', '=', 'student_grades.grade_id')
                    ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                    ->Join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                    ->where('day_name', '=', 'senin')
                    ->where('student_id', '=', $student->student_id)
                    ->get();

        $selasa = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                    ->join('student_grades', 'lesson_schedules.grade_id', '=', 'student_grades.grade_id')
                    ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                    ->Join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                    ->where('day_name', '=', 'selasa')
                    ->where('student_id', '=', $student->student_id)
                    ->get();

        $rabu = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                    ->join('student_grades', 'lesson_schedules.grade_id', '=', 'student_grades.grade_id')
                    ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                    ->Join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                    ->where('day_name', '=', 'rabu')
                    ->where('student_id', '=', $student->student_id)
                    ->get();

        $kamis = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                    ->join('student_grades', 'lesson_schedules.grade_id', '=', 'student_grades.grade_id')
                    ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                    ->Join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                    ->where('day_name', '=', 'kamis')
                    ->where('student_id', '=', $student->student_id)
                    ->get();

        $jumat = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                    ->join('student_grades', 'lesson_schedules.grade_id', '=', 'student_grades.grade_id')
                    ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                    ->Join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                    ->where('day_name', '=', 'jumat')
                    ->where('student_id', '=', $student->student_id)
                    ->get();

        // dd($senin);

        return view('pages.jadwal.jadwal-mapel-siswa',compact('senin', 'selasa', 'rabu', 'kamis', 'jumat'));
    }
}
