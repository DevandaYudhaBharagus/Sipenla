<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\StudentGrade;
use App\Models\AcademicYears;
use App\Helpers\ResponseFormatter;

class RaporController extends Controller
{
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

    public function raporConfirm($student, $semester, $academic)
    {
        try{
            $edit = [
                "status" => "rpk"
            ];

            $editPenilaian = Penilaian::where('student_id', '=', $student)
                            ->where('semester_id', '=', $semester)
                            ->where('academic_year_id', '=', $academic)
                            ->update($edit);

            return ResponseFormatter::success([], 'Update Rapor Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAcademicById($academic)
    {
        try{
            $academicYear = AcademicYears::where('academic_year_id', '=', $academic)->first();

            $response = $academicYear;

            return ResponseFormatter::success($response, 'Get Academic Year Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getFixNilai($student, $grade, $semester, $academic, $subject)
    {
        try{
            $mapel = Penilaian::join('subjects', 'penilaians.subject_id', '=', 'subjects.subject_id')
                        ->where('penilaians.student_id', '=', $student)
                        ->where('penilaians.grade_id', '=', $grade)
                        ->where('penilaians.semester_id', '=', $semester)
                        ->where('penilaians.academic_year_id', '=', $academic)
                        ->where('penilaians.subject_id', '=', $subject)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "subject_name"
                        ]);
            $tugas1 = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 1)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas1){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $tugas2 = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 2)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas2){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $tugas3 = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 3)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas3){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $tugas4 = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 4)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas4){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uh1 = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 5)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$uh1){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uh2 = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 6)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$uh2){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uh3 = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 7)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$uh3){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uh4 = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 8)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$uh4){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uts = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 9)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$uts){
                return ResponseFormatter::error([], 'Not Found', 404);
            }

            $uas = Penilaian::where('student_id', '=', $student)
                        ->where('grade_id', '=', $grade)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 10)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "nilai"
                        ]);

            if(!$uas){
                return ResponseFormatter::error([], 'Not Found', 404);
            }
            $nilai = ((($uh1->nilai + $uh2->nilai + $uh3->nilai + $uh4->nilai) / 4) * (20/100)) +
                     ((($tugas1->nilai + $tugas2->nilai + $tugas3->nilai + $tugas4->nilai) / 4) * (10/100)) +
                     ($uts->nilai * (30/100)) +
                     ($uas->nilai * (40/100));

            $response = [
            "mapel" => $mapel->subject_name,
            "totalNilai" => $nilai,
        ];

        return ResponseFormatter::success($response, 'Get Rapor Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
