<?php

namespace App\Http\Controllers\API;

use App\Models\Semester;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Penilaian;
use App\Models\StudentGrade;
use App\Models\Assessment;
use App\Models\Student;
use App\Models\AcademicYears;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function getSemester()
    {
        try{
            $semester = Semester::get();

            $response = $semester;

            return ResponseFormatter::success($response, 'Get Semester Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getSubjectAll()
    {
        try{
            $subject = Subject::get();

            $response = $subject;

            return ResponseFormatter::success($response, 'Get Subject Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getGradeAll()
    {
        try{
            $grade = Grade::get();

            $response = $grade;

            return ResponseFormatter::success($response, 'Get Grade Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getSemesterById($id)
    {
        try{
            $semester = Semester::where('semester_id', '=', $id)->first();

            $response = $semester;

            return ResponseFormatter::success($response, 'Get Semester Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAssessment()
    {
        try{
            $assessment = Assessment::get();

            $response = $assessment;

            return ResponseFormatter::success($response, 'Get Assessment Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAssessmentById($id)
    {
        try{
            $assessment = Assessment::where('assessment_id', '=', $id)->first();

            $response = $assessment;

            return ResponseFormatter::success($response, 'Get Assessment Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getStudent($grade)
    {
        try{
            $nilai = StudentGrade::join('students', 'student_grades.student_id', '=', 'students.student_id')
                    ->where('student_grades.grade_id', '=', $grade)
                    ->get([
                        'students.student_id',
                        'first_name',
                        'last_name',
                        'nisn'
                    ]);

            $fix = [];

            foreach ($nilai as $n) {
                array_push($fix, (object)["Student"=>$n,]);
            }

            $response = $fix;

            return ResponseFormatter::success($response, 'Get Student Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function addPenilaian(Request $request)
    {
        try{
            if($request->isMethod('post')){
                $bookData = $request->all();

                foreach($bookData['books'] as $key => $value){
                    if($value['nilai'] > 100 || $value['nilai'] < 0){
                        return ResponseFormatter::error([], 'Nilai Tidak Sesuai', 400);
                    }
                    $book = new Penilaian;
                    $book->student_id = $value['student_id'];
                    $book->grade_id = $value['grade_id'];
                    $book->subject_id = $value['subject_id'];
                    $book->assessment_id = $value['assessment_id'];
                    $book->academic_year_id = $value['academic_year_id'];
                    $book->semester_id = $value['semester_id'];
                    $book->nilai = $value['nilai'];
                    $book->status = "default";
                    $book->save();
                }
                return ResponseFormatter::success("Succeed Penilaian Siswa.");
            }
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function editPenilaian(Request $request, $id)
    {
        try{
            $edit = [
                "nilai" => $request->nilai
            ];

            $updateNilai = Penilaian::where('penilaian_id', '=', $id)->update($edit);

            return ResponseFormatter::success('Penilaian Has Been Updated');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getNilai($grade, $subject, $semester, $assessment)
    {
        try{
            $nilai = Penilaian::join('students', 'penilaians.student_id', '=', 'students.student_id')
                        ->where("penilaians.grade_id", "=", $grade)
                        ->where("penilaians.subject_id", "=", $subject)
                        ->where("penilaians.semester_id", "=", $semester)
                        ->where("penilaians.assessment_id", "=", $assessment)
                        ->get([
                            "penilaian_id",
                            "nisn",
                            "first_name",
                            "last_name",
                            "nilai",
                        ]);

            $response = $nilai;

            return ResponseFormatter::success($response, 'Get Student Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAcademic()
    {
        try{
            $academic = AcademicYears::get();

            $response = $academic;

            return ResponseFormatter::success($response, 'Get Academic Year Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getGradeForStudent()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();
            $grade = StudentGrade::join('grades', 'student_grades.grade_id', '=', 'grades.grade_id')
                    ->where('student_id', '=', $student->student_id)
                    ->get([
                        'grades.grade_id',
                        'grades.grade_name'
                    ]);

            $response = $grade;

            return ResponseFormatter::success($response, 'Get Grade Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryPenilaian($grade, $semester, $academic, $subject)
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();

            $mapel = Penilaian::join('subjects', 'penilaians.subject_id', '=', 'subjects.subject_id')
                        ->join('lesson_schedules', 'subjects.subject_id', '=', 'lesson_schedules.subject_id')
                        ->join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                        ->where('penilaians.student_id', '=', $student->student_id)
                        ->where('penilaians.grade_id', '=', $grade)
                        ->where('penilaians.semester_id', '=', $semester)
                        ->where('penilaians.academic_year_id', '=', $academic)
                        ->where('penilaians.subject_id', '=', $subject)
                        ->where('penilaians.assessment_id', '=', 1)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "first_name",
                            "last_name",
                            "subject_name"
                        ]);

            $tugas1 = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 1)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas1){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $tugas2 = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 2)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas2){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $tugas3 = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 3)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas3){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $tugas4 = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 4)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas4){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uh1 = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 5)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uh1){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uh2 = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 6)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uh2){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uh3 = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 7)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uh3){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uh4 = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 8)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uh4){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uts = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 9)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uts){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uas = Penilaian::where('student_id', '=', $student->student_id)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 10)
                        ->where('penilaians.status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uas){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $response = [
                "firstName" => $mapel->first_name,
                "lastName" => $mapel->last_name,
                "mapel" => $mapel->subject_name,
                "nilaiTugas1" => $tugas1->nilai,
                "nilaiTugas2" => $tugas2->nilai,
                "nilaiTugas3" => $tugas3->nilai,
                "nilaiTugas4" => $tugas4->nilai,
                "nilaiUH1" => $uh1->nilai,
                "nilaiUH2" => $uh2->nilai,
                "nilaiUH3" => $uh3->nilai,
                "nilaiUH4" => $uh4->nilai,
                "nilaiUTS" => $uts->nilai,
                "nilaiUAS" => $uas->nilai,
            ];

            return ResponseFormatter::success($response, 'Get History Success');

        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
