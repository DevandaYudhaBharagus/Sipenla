<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\StudentGrade;
use App\Models\AcademicYears;
use App\Models\Rapor;
use App\Models\Grade;
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

    public function raporConfirm($student, $semester, $academic, $subject, $grade)
    {
        try{
            $edit = [
                "status" => "rpk"
            ];

            $tugas1 = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 1)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas1){
                return ResponseFormatter::error('Tugas 1 Belum Diinputkan', 400);
            }

            $tugas2 = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 2)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas2){
                return ResponseFormatter::error('Tugas 2 Belum Diinputkan', 400);
            }

            $tugas3 = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 3)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas3){
                return ResponseFormatter::error('Tugas 3 Belum Diinputkan', 400);
            }

            $tugas4 = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 4)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$tugas4){
                return ResponseFormatter::error('Tugas 4 Belum Diinputkan', 400);
            }

            $uh1 = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 5)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uh1){
                return ResponseFormatter::error('Ulangan Harian 1 Belum Diinputkan', 400);
            }

            $uh2 = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 6)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uh2){
                return ResponseFormatter::error('Ulangan Harian 2 Belum Diinputkan', 400);
            }

            $uh3 = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 7)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uh3){
                return ResponseFormatter::error('Ulangan Harian 3 Belum Diinputkan', 400);
            }

            $uh4 = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 8)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uh4){
                return ResponseFormatter::error('Ulangan Harian 4 Belum Diinputkan', 400);
            }

            $uts = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 9)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uts){
                return ResponseFormatter::error('Ulangan Tengah Semester Belum Diinputkan', 400);
            }

            $uas = Penilaian::where('student_id', '=', $student)
                        ->where('semester_id', '=', $semester)
                        ->where('academic_year_id', '=', $academic)
                        ->where('subject_id', '=', $subject)
                        ->where('assessment_id', '=', 10)
                        ->where('status', '=', 'default')
                        ->first([
                            "nilai"
                        ]);

            if(!$uas){
                return ResponseFormatter::error('Ulangan Akhir Semester Belum Diinputkan', 400);
            }

            $nilai = ((($uh1->nilai + $uh2->nilai + $uh3->nilai + $uh4->nilai) / 4) * (20/100)) +
                    ((($tugas1->nilai + $tugas2->nilai + $tugas3->nilai + $tugas4->nilai) / 4) * (10/100)) +
                    ($uts->nilai * (30/100)) + ($uas->nilai * (40/100));

            $editPenilaian = Penilaian::where('student_id', '=', $student)
                            ->where('semester_id', '=', $semester)
                            ->where('subject_id', '=', $subject)
                            ->where('academic_year_id', '=', $academic)
                            ->update($edit);

            $addNilai = Rapor::create([
                "student_id" => $student,
                "subject_id" => $subject,
                "grade_id" => $grade,
                "nilai_fix" => $nilai,
                "status" => "default"
            ]);

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
                        ->join('lesson_schedules', 'subjects.subject_id', '=', 'lesson_schedules.subject_id')
                        ->join('employees', 'lesson_schedules.teacher_id', '=', 'employees.employee_id')
                        ->where('penilaians.student_id', '=', $student)
                        ->where('penilaians.grade_id', '=', $grade)
                        ->where('penilaians.semester_id', '=', $semester)
                        ->where('penilaians.academic_year_id', '=', $academic)
                        ->where('penilaians.subject_id', '=', $subject)
                        ->whereIn('penilaians.status', ['default', 'rpk'])
                        ->first([
                            "first_name",
                            "last_name",
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];

                return ResponseFormatter::success($response, 'Get History Success');
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
                $response = [
                    "firstName" => '-',
                    "lastName" => '-',
                    "mapel" => '-',
                    "nilaiTugas1" => 0,
                    "nilaiTugas2" => 0,
                    "nilaiTugas3" => 0,
                    "nilaiTugas4" => 0,
                    "nilaiUH1" => 0,
                    "nilaiUH2" => 0,
                    "nilaiUH3" => 0,
                    "nilaiUH4" => 0,
                    "nilaiUTS" => 0,
                    "nilaiUAS" => 0,
                    "nilaiFix" => 0
                ];
                return ResponseFormatter::success($response, 'Get History Success');
            }
            $nilai = ((($uh1->nilai + $uh2->nilai + $uh3->nilai + $uh4->nilai) / 4) * (20/100)) +
                    ((($tugas1->nilai + $tugas2->nilai + $tugas3->nilai + $tugas4->nilai) / 4) * (10/100)) +
                    ($uts->nilai * (30/100)) + ($uas->nilai * (40/100));

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
                    "nilaiFix" => $nilai
                ];

                return ResponseFormatter::success($response, 'Get History Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getNilaiForConfirm()
    {
        try{
            $nilai = Grade::get();

            $response = $nilai;

            return ResponseFormatter::success($response, 'Get Grade Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateStatusKepsek($grade){
        try{
            $edit = [
                "status" => "rkk"
            ];
            $nilai = Rapor::where('grade_id', '=', $grade)
                    ->update($edit);

            return ResponseFormatter::success([], 'Approve Nilai Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
