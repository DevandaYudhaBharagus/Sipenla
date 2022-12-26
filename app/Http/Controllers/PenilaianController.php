<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Employee;
use App\Models\Semester;
use App\Models\Assessment;
use App\Models\Penilaian;
use App\Models\StudentGrade;
use Illuminate\Http\Request;
use App\Models\AcademicYears;
use App\Models\LessonSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PenilaianController extends Controller
{



    public function index()
    {
        return view('pages.penilaian.pil-penilaian');
    }

    public function riwayatPenilaian(Request $request)
    {

        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
        $grade =  LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
        ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
        ->get([
            'grades.grade_id',
            'grade_name',
            'start_time',
            'end_time',
            'subject_name',
            'subjects.subject_id'
        ]);

        $subject = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
        ->first([
            'subjects.subject_id',
            'subject_name'
        ]);

        $semester = Semester::get();
        $academic = AcademicYears::get();
        $assessment = Assessment::get();

        return view('pages.penilaian.riwayat-penilaian-blank', compact('semester','academic', 'subject', 'assessment','grade'));
    }

    public function getRiwayat(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data,[
            'grade' => 'required',
            'mapel' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'penilaian' => 'required'
        ],
        [
            'grade.required' => 'Kelas Harus Diisi.',
            'mapel.required' => 'Mata Pelajaran Harus Diisi.',
            'semester.required' => 'Semester Harus Diisi.',
            'tahun.required' => 'Tahun Akademik Harus Diisi.',
            'penilaian.required' => 'Jenis Penilaian Harus Diisi.',
        ]
        );

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()->toArray()
            ]);
        }

        $nilai = Penilaian::join('students', 'penilaians.student_id', '=', 'students.student_id')
                        ->where("penilaians.grade_id", "=", $request->grade)
                        ->where("penilaians.subject_id", "=", $request->mapel)
                        ->where("penilaians.semester_id", "=", $request->semester)
                        ->where("penilaians.assessment_id", "=", $request->penilaian)
                        ->where("penilaians.academic_year_id", "=", $request->tahun)
                        ->get([
                            "penilaian_id",
                            "nisn",
                            "first_name",
                            "last_name",
                            "nilai",
                        ]);


        $grades = Grade::where('grade_id', '=', $request->grade)->first();
        $subjects = Subject::where('subject_id', '=', $request->mapel)->first();
        $semesters = Semester::where('semester_id', '=', $request->semester)->first();
        $academics = AcademicYears::where('academic_year_id', '=', $request->tahun)->first();
        $assessments = Assessment::where('assessment_id', '=', $request->penilaian)->first();
        return view('pages.penilaian.riwayat-penilaian', compact('nilai','grades','subjects','semesters','academics','assessments'));
    }

    public function getFilteringPenilaian(){

        //Noteeeeee
        $user = Auth::user();
        $employee = Employee::where('user_id', '=', $user->id)->first();
        $grade =  LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
        ->join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
        ->get([
            'grades.grade_id',
            'grade_name',
            'start_time',
            'end_time',
            'subject_name',
            'subjects.subject_id'
        ]);

        $subject = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
        ->first([
            'subjects.subject_id',
            'subject_name'
        ]);

        $semester = Semester::get();
        $academic = AcademicYears::get();
        $assessment = Assessment::get();



        return view('pages.penilaian.penilaian-blank', compact('semester','academic', 'subject', 'assessment','grade'));
    }

    public function PenilaianSiswa(Request $request){
        $data = $request->all();

        $validate = Validator::make($data,[
            'grade' => 'required',
            'mapel' => 'required',
            'semester' => 'required',
            'tahun' => 'required',
            'penilaian' => 'required'
        ],
        [
            'grade.required' => 'Kelas Harus Diisi.',
            'mapel.required' => 'Mata Pelajaran Harus Diisi.',
            'semester.required' => 'Semester Harus Diisi.',
            'tahun.required' => 'Tahun Akademik Harus Diisi.',
            'penilaian.required' => 'Jenis Penilaian Harus Diisi.',
        ]
    );

    if ($validate->fails()) {
        return response()->json([
            'error' => $validate->errors()->toArray()
        ]);
    }


        $student = StudentGrade::join('students', 'student_grades.student_id', '=', 'students.student_id')
        ->where('student_grades.grade_id', '=', $request->grade)
        ->get([
            'students.student_id',
            'first_name',
            'last_name',
            'nisn'
        ]);


        $grades = Grade::where('grade_id', '=', $request->grade)->first();
        $subjects = Subject::where('subject_id', '=', $request->mapel)->first();
        $semesters = Semester::where('semester_id', '=', $request->semester)->first();
        $academics = AcademicYears::where('academic_year_id', '=', $request->tahun)->first();
        $assessments = Assessment::where('assessment_id', '=', $request->penilaian)->first();

        return view('pages.penilaian.penilaian', compact('student','grades','subjects','semesters','academics','assessments'));
    }

    public function penilaianStore(Request $request)
    {
        foreach($request->student_id as $key => $value){
                if($request->nilai[$key] > 100 || $request->nilai[$key] < 0){
                    return response()->json([
                        'error' => "Nilai Melebihi Batas yang Ditentukan"
                    ]);
                }
                Penilaian::create([
                    'student_id' => $request->student_id[$key],
                    'nilai' => $request->nilai[$key],
                    'grade_id' => $request->grade_id,
                    'subject_id' => $request->subject_id,
                    'semester_id' => $request->semester_id,
                    'academic_year_id' => $request->academic_year_id,
                    'assessment_id' => $request->assessment_id,
                    'status' => "default",
                ]);
        }

        return redirect('/penilaian')->with('status', 'Penilaian Berhasil Terisi!');
    }

    public function edit($id)
    {
        $where = array('penilaian_id' => $id);
        $post  = Penilaian::join('students', 'penilaians.student_id', 'students.student_id')->where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = Penilaian::where('penilaian_id', $id);
        $student->update($data);
    }
}
