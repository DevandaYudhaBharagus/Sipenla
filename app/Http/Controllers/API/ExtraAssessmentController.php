<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use App\Models\PenilaianExtra;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseFormatter;

class ExtraAssessmentController extends Controller
{
    public function getStudent()
    {
        try{
            $user = Auth::user();
            $employee = Employee::join('extra_schedules', 'employees.employee_id', '=', 'extra_schedules.teacher_id')
                    ->where('user_id', '=', $user->id)
                    ->first();

            $student = Student::where('extracurricular_id', '=', $employee->extracurricular_id)
                        ->get([
                            "student_id",
                            "first_name",
                            "last_name",
                        ]);

            $response = $student;

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
                    $book = new PenilaianExtra;
                    $book->student_id = $value['student_id'];
                    $book->extracurricular_id = $value['extracurricular_id'];
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

            $updateNilai = PenilaianExtra::where('penilaian_extra_id', '=', $id)->update($edit);

            return ResponseFormatter::success('Penilaian Has Been Updated');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
