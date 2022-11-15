<?php

namespace App\Http\Controllers\API;

use App\Models\Semester;
use App\Models\Subject;
use App\Models\Grade;
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
}
