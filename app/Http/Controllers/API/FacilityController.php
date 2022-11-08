<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\LoanFacility;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Student;

class FacilityController extends Controller
{
    public function saveImage($image, $path='public')
    {
        try{
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
        }catch (Exception $e) {
            $statuscode = 500;
            if ($e->getCode()) $statuscode = $e->getCode();

            $response = [
                'errors' => $e->getMessage(),
            ];

            return ResponseFormatter::error($response, 'Something went wrong', $statuscode);
        }
    }

    public function getAllFacility()
    {
        try{
            $facility = Facility::orderBy('created_at', 'desc')->get();

            if(is_null($facility)){
                return ResponseFormatter::error('Not Found', 404);
            }

            foreach ($facility as $n) {
                $time = $n->date;
                $test2 = ($n->date !== null) ? date('d F Y', strtotime($time)) : '';
                $n->date = $test2;
            }

            $response = [
                $facility
            ];

            return ResponseFormatter::success($response, 'Get News Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function createFacility(Request $request)
    {
        try{
            $data = $request->all();

            $validate = Validator::make($data, [
                'facility_name' => 'required',
                'number_of_facility' => 'required',
                'year' => 'required',
                'owned_by' => 'required'
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $image = $this->saveImage($request->facility_image, "azure");
            $code = mt_rand(1000, 9999);

            $facilityData = Facility::create([
                'facility_code' => $code,
                'facility_name' => $data['facility_name'],
                'number_of_facility' => $data['number_of_facility'],
                'year' => $data['year'],
                'owned_by' => $data['owned_by'],
                'status' => "default",
                'date' => Carbon::now(),
                "image" => $image
            ]);
            return ResponseFormatter::success( "Succeed added Facility Data.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function editFacility(Request $request, $id)
    {
        try{
            if($request->facility_image == null){
                $edit = [
                    "facility_name" => $request->facility_name,
                    "number_of_facility" => $request->number_of_facility,
                    "year" => $request->year,
                    "owned_by" => $request->owned_by,
                    "updated_at" => Carbon::now()
                ];
                $updateFacility = Facility::where('facility_id', '=', $id)
                            ->update($edit);

                return ResponseFormatter::success('Facility Has Been Updated');
            }
            $image = $this->saveImage($request->facility_image, "students");

            $edit = [
                "facility_name" => $request->facility_name,
                "number_of_facility" => $request->number_of_facility,
                "year" => $request->year,
                "owned_by" => $request->owned_by,
                "image" => $image,
                "updated_at" => Carbon::now()
            ];


            $updateFacility = Facility::where('facility_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Facility Has Been Updated');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function deleteFacility($id)
    {
        try{
            $deleteFacility = Facility::where('facility_id', '=', $id)
            ->delete();

            return ResponseFormatter::success('Facility Has Been Deleted');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getFacilityByCode($code)
    {
        try{
            $facility = Facility::where('facility_code', '=', $code)
                        ->where('status', '=', 'fcl')
                        ->get();

            $response = $facility;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getFacility()
    {
        try{
            $facility = Facility::where('status', '=', 'fcl')
                        ->get();

            $response = $facility;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getFacilityById($id)
    {
        try{
            $facility = Facility::where('facility_id', '=', $id)
                        ->get();

            $response = $facility;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function createLoan(Request $request)
    {
        try{
            if($request->isMethod('post')){
                $bookData = $request->all();
                $user = Auth::user();
                if($user === "student"){
                    $student = Student::where('user_id', '=', $user->id)->first();
                    foreach($bookData['books'] as $key => $value){
                        $book = new LoanFacility;
                        $book->facility_id = $value['facility_id'];
                        $book->total_facility = $value['total_facility'];
                        $book->from_date = $value['from_date'];
                        $book->to_date = $value['to_date'];
                        $book->date = Carbon::now();
                        $book->status = 'ppf';
                        $book->student_id = $student->student_id;
                        $book->save();
                    }
                    return ResponseFormatter::success("Sukses Mengajukan Peminjaman.");
                }
                $employee = Employee::where('user_id', '=', $user->id)->first();
                foreach($bookData['books'] as $key => $value){
                    $book = new LoanFacility;
                    $book->facility_id = $value['facility_id'];
                    $book->total_facility = $value['total_facility'];
                    $book->from_date = $value['from_date'];
                    $book->to_date = $value['to_date'];
                    $book->date = Carbon::now();
                    $book->status = 'ppf';
                    $book->employee_id = $employee->employee_id;
                    $book->save();
                }
                return ResponseFormatter::success("Sukses Mengajukan Peminjaman.");
            }
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAllLoanStudent()
    {
        try{
            $loanStudent = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                    ->whereNotNull("loan_facilities.student_id")
                    ->join('students', 'loan_facilities.student_id', '=', 'students.student_id')
                    ->where('loan_facilities.status', '=', 'ppf')
                    ->get();

            $response = $loanStudent;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAllLoanEmployee()
    {
        try{
            $loanEmployee = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                    ->whereNotNull("loan_facilities.employee_id")
                    ->join('employees', 'loan_facilities.employee_id', '=', 'employees.employee_id')
                    ->where('loan_facilities.status', '=', 'ppf')
                    ->get();

            $response = $loanEmployee;

            return ResponseFormatter::success($response, 'Get Facility Success');

        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAllReturnEmployee()
    {
        try{
            $loanEmployee = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                    ->whereNotNull("loan_facilities.employee_id")
                    ->join('employees', 'loan_facilities.employee_id', '=', 'employees.employee_id')
                    ->where('loan_facilities.status', '=', 'prf')
                    ->get();

            $response = $loanEmployee;

            return ResponseFormatter::success($response, 'Get Facility Success');

        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAllReturnStudent()
    {
        try{
            $loanStudent = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                    ->whereNotNull("loan_facilities.student_id")
                    ->join('students', 'loan_facilities.student_id', '=', 'students.student_id')
                    ->where('loan_facilities.status', '=', 'prf')
                    ->get();

            $response = $loanStudent;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function approvalLoan($id)
    {
        try{
            $edit = [
                "status" => 'opf'
            ];


            $updateFacility = LoanFacility::where('loan_facility_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Facility Has Been approved');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getFacilityOngoing()
    {
        try{
            $user = Auth::user();
            if($user->role === "student"){
                $student = Student::where('user_id', '=', $user->id)->first();
                $facility = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                            ->where('loan_facilities.student_id', '=', $student->student_id)
                            ->where('loan_facilities.status', '=', 'opf')
                            ->get();

                $response = $facility;

                return ResponseFormatter::success($response, 'Get Facility Success');
            }
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $facility = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                        ->where('loan_facilities.employee_id', '=', $employee->employee_id)
                        ->where('loan_facilities.status', '=', 'opf')
                        ->get();

            $response = $facility;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function pendingReturn($id)
    {
        try{
            $edit = [
                "status" => 'prf'
            ];


            $updateFacility = LoanFacility::where('loan_facility_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Facility Has Been Returned, wait until TU approved it');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function returned($id)
    {
        try{
            $edit = [
                "status" => 'prd'
            ];


            $updateFacility = LoanFacility::where('loan_facility_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Facility Has Been Approved to Return');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyByUser()
    {
        try{
            $user = Auth::user();
            if($user->role === "student"){
                $student = Student::where('user_id', '=', $user->id)->first();
                $facility = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                            ->where('loan_facilities.student_id', '=', $student->student_id)
                            ->whereIn('loan_facilities.status', ['prd', 'opf'])
                            ->get();

                $response = $facility;

                return ResponseFormatter::success($response, 'Get Facility Success');
            }
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $facility = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                        ->where('loan_facilities.employee_id', '=', $employee->employee_id)
                        ->whereIn('loan_facilities.status', ['prd', 'opf'])
                        ->get();

            $response = $facility;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyTuEmployee()
    {
        try{
            $loanEmployee = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                            ->whereNotNull("loan_facilities.employee_id")
                            ->join('employees', 'loan_facilities.employee_id', '=', 'employees.employee_id')
                            ->whereIn('loan_facilities.status', ['prd', 'opf'])
                            ->get();

            $response = $loanEmployee;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyTuStudent()
    {
        try{
            $loanEmployee = LoanFacility::join('facilities', 'loan_facilities.facility_id', '=', 'facilities.facility_id')
                            ->whereNotNull("loan_facilities.student_id")
                            ->join('students', 'loan_facilities.student_id', '=', 'students.student_id')
                            ->whereIn('loan_facilities.status', ['prd', 'opf'])
                            ->get();

            $response = $loanEmployee;

            return ResponseFormatter::success($response, 'Get Facility Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
