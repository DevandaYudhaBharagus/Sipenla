<?php

namespace App\Http\Controllers\API;

use App\Models\Semester;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Penilaian;
use App\Models\StudentGrade;
use App\Models\Assessment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

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
                    $book = new Penilaian;
                    $book->student_id = $value['student_id'];
                    $book->grade_id = $value['grade_id'];
                    $book->subject_id = $value['subject_id'];
                    $book->assessment_id = $value['assessment_id'];
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
}
