<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use URL;
use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Student;
use App\Models\LoanBook;
use App\Models\Balance;
use App\Models\FineTransaction;
use Illuminate\Support\Str;
use App\Models\PerpusAttendance;
use App\Models\LoanFacility;
use Illuminate\Support\Facades\DB;

class PerpustakaanController extends Controller
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

    public function getBook()
    {
        try{
            $book = Book::where('status', '=', 'konfirm')->orderBy('created_at', 'desc')->get();

            if(is_null($book)){
                return ResponseFormatter::error('Not Found', 404);
            }

            foreach ($book as $n) {
                $time = $n->date;
                $test2 = ($n->date !== null) ? date('d F Y', strtotime($time)) : '';
                $n->date = $test2;
            }

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function addBook(Request $request)
    {
        try{
            $data = $request->all();

            $validate = Validator::make($data, [
                'book_name' => 'required',
                'book_price' => 'required',
                'book_creator' => 'required',
                'book_year' => 'required',
                'number_of_book' => 'required'
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $image = $this->saveImage($request->book_image, "azure");
            $code = mt_rand(1000, 9999);

            $facilityData = Book::create([
                'book_code' => $code,
                'book_name' => $data['book_name'],
                'book_price' => $data['book_price'],
                'book_creator' => $data['book_creator'],
                'book_year' => $data['book_year'],
                'number_of_book' => $data['number_of_book'],
                'status' => "konfirm",
                'date' => Carbon::now(),
                "image" => $image
            ]);
            return ResponseFormatter::success( "Succeed added Book Data.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateBook(Request $request, $id)
    {
        try{
            if($request->book_image == null){
                $edit = [
                    "book_name" => $request->book_name,
                    "book_price" => $request->book_price,
                    "book_creator" => $request->book_creator,
                    "book_year" => $request->book_year,
                    "number_of_book" => $request->number_of_book,
                    "updated_at" => Carbon::now()
                ];
                $updateFacility = Book::where('book_id', '=', $id)
                            ->update($edit);

                return ResponseFormatter::success('Book Has Been Updated');
            }
            $image = $this->saveImage($request->book_image, "azure");

            $edit = [
                "book_name" => $request->book_name,
                "book_price" => $request->book_price,
                "book_creator" => $request->book_creator,
                "book_year" => $request->book_year,
                "number_of_book" => $request->number_of_book,
                "updated_at" => Carbon::now(),
                "image" => $image,
            ];


            $updateFacility = Book::where('book_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Book Has Been Updated');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function deleteBook($id)
    {
        try{
            $deleteBook = Book::where('book_id', '=', $id)
            ->delete();

            return ResponseFormatter::success('Book Has Been Deleted');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getBookByCode($code)
    {
        try{
            $book = Book::where('book_code', '=', $code)
                        ->where('status', '=', 'konfirm')
                        ->first([
                            "book_id",
                            "book_code",
                            "book_name",
                            "book_price",
                            "book_price",
                            "book_price",
                            "number_of_book",
                            "status",
                            "date",
                            "image",
                        ]);

            if($book === null){
                $response = [
                    'book_id' => 0,
                    'book_code' => "-",
                    'book_name' => "-",
                    'book_price' => "-",
                    'book_price' => "-",
                    'book_price' => "-",
                    'number_of_book' => "-",
                    'status' => "-",
                    'date' => "-",
                    'image' => "-"
                ];
                return ResponseFormatter::success($response, 'Get book Success');
            }

            $response = $book;

            return ResponseFormatter::success($response, 'Get book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getBookById($id)
    {
        try{
            $book = Book::where('book_id', '=', $id)
                        ->first();

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
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
                if($user->role == "student"){
                    $student = Student::where('user_id', '=', $user->id)->first();
                    foreach($bookData['books'] as $key => $value){
                        $stock = Book::where('book_id', '=', $value['book_id'])
                                    ->get("number_of_book");
                        foreach($stock as $s){
                            if($value['total_book'] > $s->number_of_book){
                                return ResponseFormatter::error([], 'Jumlah Buku Tidak Mencukupi', 400);
                            }
                        }
                        $book = new LoanBook;
                        $book->book_id = $value['book_id'];
                        $book->total_book = $value['total_book'];
                        $book->from_date = Carbon::now();
                        $book->to_date = $value['to_date'];
                        $book->date = Carbon::now();
                        $book->status = 'pending';
                        $book->status_loan = 'default';
                        $book->student_id = $student->student_id;
                        $book->save();
                    }
                    return ResponseFormatter::success("Sukses Mengajukan Peminjaman.");
                }
                $employee = Employee::where('user_id', '=', $user->id)->first();
                foreach($bookData['books'] as $key => $value){
                    $stock = Book::where('book_id', '=', $value['book_id'])
                                ->get("number_of_book");
                    foreach($stock as $s){
                        if($value['total_book'] > $s->number_of_book){
                            return ResponseFormatter::error([], 'Jumlah Book Tidak Mencukupi', 400);
                        }
                    }

                    $book = new LoanBook;
                    $book->book_id = $value['book_id'];
                    $book->total_book = $value['total_book'];
                    $book->from_date = Carbon::now();
                    $book->to_date = $value['to_date'];
                    $book->date = Carbon::now();
                    $book->status = 'pending';
                    $book->status_loan = 'default';
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
            $loanStudent = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                    ->whereNotNull("loan_books.student_id")
                    ->join('students', 'loan_books.student_id', '=', 'students.student_id')
                    ->where('loan_books.status', '=', 'pending')
                    ->get([
                        'loan_book_id',
                        'first_name',
                        'last_name',
                        'book_code',
                        'book_name',
                        'book_creator',
                        'book_year',
                        'total_book',
                        'loan_books.status',
                        'books.image',
                        'students.nisn',
                        'from_date',
                        'to_date'
                    ]);

            $response = $loanStudent;

            return ResponseFormatter::success($response, 'Get Book Success');
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
            $loanEmployee = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                    ->whereNotNull("loan_books.employee_id")
                    ->join('employees', 'loan_books.employee_id', '=', 'employees.employee_id')
                    ->where('loan_books.status', '=', 'pending')
                    ->get([
                        'loan_book_id',
                        'first_name',
                        'last_name',
                        'book_code',
                        'book_name',
                        'book_creator',
                        'book_year',
                        'total_book',
                        'loan_books.status',
                        'books.image',
                        'employees.nuptk',
                        'from_date',
                        'to_date'
                    ]);

            $response = $loanEmployee;

            return ResponseFormatter::success($response, 'Get Book Success');

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
                "status" => 'ongoing'
            ];


            $updateBook = LoanBook::where('loan_book_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Book Has Been approved');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getBookOngoing()
    {
        try{
            $user = Auth::user();
            if($user->role === "student"){
                $student = Student::where('user_id', '=', $user->id)->first();
                $book = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                            ->where('loan_books.student_id', '=', $student->student_id)
                            ->where('loan_books.status', '=', 'ongoing')
                            ->get([
                                "loan_book_id",
                                "loan_books.book_id",
                                "total_book",
                                "from_date",
                                "to_date",
                                "book_creator",
                                "book_year",
                                "book_price",
                                "loan_books.date",
                                "loan_books.status",
                                "loan_books.created_at",
                                "loan_books.updated_at",
                                "book_code",
                                "book_name",
                                "number_of_book",
                                "image"
                            ]);

                foreach ($book as $b) {
                    $time = Carbon::parse($b->to_date);
                    $now = Carbon::now()->format('Y-m-d');
                    $different = $time->diff($now);
                    $test2 = ($now > $time) ? 2000 * $different->days : 0;
                    $status = ($now > $time) ? "Terkena Denda" : "";
                    $b->denda = $test2;
                    $b->status = $status;
                }

                $response = $book;

                return ResponseFormatter::success($response, 'Get Book Success');
            }
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $book = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                        ->where('loan_books.employee_id', '=', $employee->employee_id)
                        ->where('loan_books.status', '=', 'ongoing')
                        ->get([
                            "loan_book_id",
                            "loan_books.book_id",
                            "total_book",
                            "from_date",
                            "to_date",
                            "book_creator",
                            "book_year",
                            "book_price",
                            "loan_books.date",
                            "loan_books.status",
                            "loan_books.created_at",
                            "loan_books.updated_at",
                            "book_code",
                            "book_name",
                            "number_of_book",
                            "image"
                        ]);

            foreach ($book as $b) {
                $time = Carbon::parse($b->to_date);
                $now = Carbon::now()->format('Y-m-d');
                $different = $time->diff($now);
                $test2 = ($now > $time) ? 2000 * $different->days : 0;
                $status = ($now > $time) ? "Terkena Denda" : "";
                $b->denda = $test2;
                $b->status = $status;
            }

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
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
                "status" => 'pendingreturn'
            ];


            $updateBook = LoanBook::where('loan_book_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Book Has Been Returned, wait until Pegawai Perpus approved it');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function pendingReturnDenda(Request $request, $id)
    {
        try{
            $user = Auth::user();
            $saldo = Balance::where('user_id', '=', $user->id)->first(['balance']);
            $edit = [
                "status" => 'pendingreturn',
                "status_loan" => $request->status_loan
            ];

            if($saldo->balance < $request->fine_transaction) return ResponseFormatter::error('Saldo Tidak Mencukupi', 400);
            $code = Str::random(8);
            $fix = strtoupper($code);

            $editLogin= [
                'balance' => $saldo->balance - $request->fine_transaction
            ];

            $transaction = FineTransaction::create([
                "user_id" => $user->id,
                "fine_transaction_code" => $fix,
                "fine_transaction" => $request->fine_transaction,
                "status" => "approve",
            ]);

            $updateBook = LoanBook::where('loan_book_id', '=', $id)
                            ->update($edit);

            $login = Balance::where('user_id', '=', $user->id)
                            ->update($editLogin);

            $response = [
                "fine_transaction" => $transaction->fine_transaction,
                "fine_transaction_code" => $transaction->fine_transaction_code,
                "status" => $transaction->status,
                "waktu" => Carbon::parse($transaction->created_at)->format('d F, H.i')
            ];

            return ResponseFormatter::success($response, 'Book Has Been Returned, wait until Pegawai Perpus approved it');
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
            $loanEmployee = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                    ->whereNotNull("loan_books.employee_id")
                    ->join('employees', 'loan_books.employee_id', '=', 'employees.employee_id')
                    ->where('loan_books.status', '=', 'pendingreturn')
                    ->get([
                        'loan_book_id',
                        'first_name',
                        'last_name',
                        'book_code',
                        'book_name',
                        'book_price',
                        'total_book',
                        "book_creator",
                        "book_year",
                        'loan_books.status',
                        'books.image',
                        'employees.nuptk',
                        'from_date',
                        'to_date',
                        'status_loan'
                    ]);

            foreach ($loanEmployee as $b) {
                $time = Carbon::parse($b->to_date);
                $now = Carbon::now()->format('Y-m-d');
                $different = $time->diff($now);
                $test2 = ($now > $time) ? 2000 * $different->days : 0;
                $b->denda = $test2;
            }

            $response = $loanEmployee;

            return ResponseFormatter::success($response, 'Get Book Success');

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
            $loanStudent = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                    ->whereNotNull("loan_books.student_id")
                    ->join('students', 'loan_books.student_id', '=', 'students.student_id')
                    ->where('loan_books.status', '=', 'pendingreturn')
                    ->get([
                        'loan_book_id',
                        'first_name',
                        'last_name',
                        'book_code',
                        'book_name',
                        'book_price',
                        'total_book',
                        "book_creator",
                        "book_year",
                        'loan_books.status',
                        'books.image',
                        'students.nisn',
                        'from_date',
                        'to_date',
                        'status_loan'
                    ]);

            foreach ($loanStudent as $b) {
                $time = Carbon::parse($b->to_date);
                $now = Carbon::now()->format('Y-m-d');
                $different = $time->diff($now);
                $test2 = ($now > $time) ? 2000 * $different->days : 0;
                $b->denda = $test2;
            }

            $response = $loanStudent;

            return ResponseFormatter::success($response, 'Get Book Success');
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
                "status" => 'returned'
            ];


            $updateBook = LoanBook::where('loan_book_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Book Has Been Approved to Return');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function createSumbangBuku(Request $request)
    {
        try{
            $user = Auth::user();
            $data = $request->all();

            $validate = Validator::make($data, [
                'book_name' => 'required',
                'book_price' => 'required',
                'book_creator' => 'required',
                'book_year' => 'required',
                'number_of_book' => 'required'
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            $image = $this->saveImage($request->book_image, "azure");
            $code = mt_rand(1000, 9999);

            if($user->role == "student"){
                $student = Student::where('user_id', '=', $user->id)->first();
                $facilityData = Book::create([
                    'book_code' => $code,
                    'book_name' => $data['book_name'],
                    'book_price' => $data['book_price'],
                    'book_creator' => $data['book_creator'],
                    'book_year' => $data['book_year'],
                    'number_of_book' => $data['number_of_book'],
                    'status' => "pending",
                    'date' => Carbon::now(),
                    "image" => $image,
                    "student_id" => $student->student_id
                ]);
                return ResponseFormatter::success( "Succeed added Book Data.");
            }
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $facilityData = Book::create([
                'book_code' => $code,
                'book_name' => $data['book_name'],
                'book_price' => $data['book_price'],
                'book_creator' => $data['book_creator'],
                'book_year' => $data['book_year'],
                'number_of_book' => $data['number_of_book'],
                'status' => "pending",
                'date' => Carbon::now(),
                "image" => $image,
                "employee_id" => $employee->employee_id
            ]);
            return ResponseFormatter::success( "Succeed added Book Data.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getListSumbanganStudent()
    {
        try{
            $book = Book::whereNotNull("books.student_id")
                    ->join('students', 'books.student_id', '=', 'students.student_id')
                    ->where('books.status', '=', 'pending')
                    ->get([
                        'book_id',
                        'students.first_name',
                        'students.last_name',
                        'students.nisn',
                        'book_code',
                        'book_name',
                        'book_price',
                        'book_creator',
                        'book_year',
                        'number_of_book',
                        'books.status',
                        'books.image'
                    ]);

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getListSumbanganEmployee()
    {
        try{
            $book = Book::whereNotNull("books.employee_id")
                    ->join('employees', 'books.employee_id', '=', 'employees.employee_id')
                    ->where('books.status', '=', 'pending')
                    ->get([
                        'book_id',
                        'employees.first_name',
                        'employees.last_name',
                        'employees.nuptk',
                        'book_code',
                        'book_name',
                        'book_price',
                        'book_creator',
                        'book_year',
                        'number_of_book',
                        'books.status',
                        'books.image'
                    ]);

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function approveSumbangan($id)
    {
        try{
            $edit = [
                "status" => 'konfirm'
            ];


            $updateBook = Book::where('book_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Book Has Been Approved');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function rejectSumbangan($id)
    {
        try{
            $edit = [
                "status" => 'reject'
            ];


            $updateBook = Book::where('book_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Book Has Been Rejected');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function rejectPengajuan($id)
    {
        try{
            $edit = [
                "status" => 'reject'
            ];


            $updateBook = LoanBook::where('loan_book_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Book Has Been Rejected');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryForUser()
    {
        try{
            $user = Auth::user();
            if($user->role === "student"){
                $student = Student::where('user_id', '=', $user->id)->first();
                $book = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                            ->where('loan_books.student_id', '=', $student->student_id)
                            ->whereIn('loan_books.status', ['ongoing', 'returned'])
                            ->orderBy('loan_books.created_at', 'desc')
                            ->get([
                                'book_code',
                                'book_name',
                                'book_creator',
                                'book_year',
                                'total_book',
                                'loan_books.status',
                                'loan_books.date',
                                'loan_books.status',
                            ]);

                foreach ($book as $f) {
                    $time = $f->date;
                    $test2 = ($f->date !== null) ? date('d F Y', strtotime($time)) : '';
                    $f->date = $test2;
                }

                $response = $book;

                return ResponseFormatter::success($response, 'Get Book Success');
            }
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $book = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                        ->where('loan_books.employee_id', '=', $employee->employee_id)
                        ->whereIn('loan_books.status', ['ongoing', 'returned'])
                        ->orderBy('loan_books.created_at', 'desc')
                        ->get([
                            'book_code',
                            'book_name',
                            'book_creator',
                            'book_year',
                            'total_book',
                            'loan_books.status',
                            'loan_books.date',
                            'loan_books.status',
                        ]);

            foreach ($book as $f) {
                $time = $f->date;
                $test2 = ($f->date !== null) ? date('d F Y', strtotime($time)) : '';
                $f->date = $test2;
            }

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistorySumbangForUser()
    {
        try{
            $user = Auth::user();
            if($user->role === "student"){
                $student = Student::where('user_id', '=', $user->id)->first();
                $book = Book::where('books.student_id', '=', $student->student_id)
                            ->whereIn('books.status', ['rejected', 'konfirm'])
                            ->orderBy('books.created_at', 'desc')
                            ->get([
                                'book_code',
                                'book_name',
                                'book_creator',
                                'book_year',
                                'books.status',
                                'books.date',
                                'books.status',
                            ]);

                foreach ($book as $f) {
                    $time = $f->date;
                    $test2 = ($f->date !== null) ? date('d F Y', strtotime($time)) : '';
                    $f->date = $test2;
                }

                $response = $book;

                return ResponseFormatter::success($response, 'Get Book Success');
            }
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $book = Book::where('books.employee_id', '=', $employee->employee_id)
                        ->whereIn('books.status', ['rejected', 'konfirm'])
                        ->orderBy('books.created_at', 'desc')
                        ->get([
                            'book_code',
                            'book_name',
                            'book_creator',
                            'book_year',
                            'books.status',
                            'books.date',
                            'books.status',
                        ]);

            foreach ($book as $f) {
                $time = $f->date;
                $test2 = ($f->date !== null) ? date('d F Y', strtotime($time)) : '';
                $f->date = $test2;
            }

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryPeminjamanEmployee($date)
    {
        try{
            $loanEmployee = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                    ->whereNotNull("loan_books.employee_id")
                    ->join('employees', 'loan_books.employee_id', '=', 'employees.employee_id')
                    ->whereIn('loan_books.status', ['ongoing', 'returned'])
                    ->where('loan_books.date', '=', $date)
                    ->get([
                        'loan_book_id',
                        'first_name',
                        'last_name',
                        'book_code',
                        'book_name',
                        'book_creator',
                        'book_year',
                        'total_book',
                        'loan_books.status',
                        'books.image',
                        'employees.nuptk',
                        'from_date',
                        'to_date'
                    ]);

            $response = $loanEmployee;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryPeminjamanStudent($date)
    {
        try{
            $loanStudent = LoanBook::join('books', 'loan_books.book_id', '=', 'books.book_id')
                    ->whereNotNull("loan_books.student_id")
                    ->join('students', 'loan_books.student_id', '=', 'students.student_id')
                    ->whereIn('loan_books.status', ['ongoing', 'returned'])
                    ->where('loan_books.date', '=', $date)
                    ->get([
                        'loan_book_id',
                        'first_name',
                        'last_name',
                        'book_code',
                        'book_name',
                        'book_creator',
                        'book_year',
                        'total_book',
                        'loan_books.status',
                        'books.image',
                        'students.nisn',
                        'from_date',
                        'to_date'
                    ]);

            $response = $loanStudent;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistorySumbangStudent($date)
    {
        try{
            $book = Book::whereNotNull("books.student_id")
                    ->join('students', 'books.student_id', '=', 'students.student_id')
                    ->whereIn('books.status', ['konfirm', 'rejected'])
                    ->where('books.date', '=', $date)
                    ->get([
                        'book_id',
                        'first_name',
                        'last_name',
                        'book_code',
                        'book_name',
                        'book_creator',
                        'book_year',
                        'books.status',
                        'books.image',
                        'students.nisn',
                        'books.date'
                    ]);

            foreach ($book as $f) {
                $time = $f->date;
                $test2 = ($f->date !== null) ? date('d F Y', strtotime($time)) : '';
                $f->date = $test2;
            }

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistorySumbangEmployee($date)
    {
        try{
            $book = Book::whereNotNull("books.employee_id")
                    ->join('employees', 'books.employee_id', '=', 'employees.employee_id')
                    ->whereIn('books.status', ['konfirm', 'rejected'])
                    ->where('books.date', '=', $date)
                    ->get([
                        'book_id',
                        'first_name',
                        'last_name',
                        'book_code',
                        'book_name',
                        'book_creator',
                        'book_year',
                        'books.status',
                        'books.image',
                        'employees.nuptk',
                        'books.date'
                    ]);

            foreach ($book as $f) {
                $time = $f->date;
                $test2 = ($f->date !== null) ? date('d F Y', strtotime($time)) : '';
                $f->date = $test2;
            }

            $response = $book;

            return ResponseFormatter::success($response, 'Get Book Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getBarcodePegawai($nuptk)
    {
        try{
            $employee = Employee::join('users', 'employees.user_id', '=', 'users.id')->where('nuptk', '=',  $nuptk)->first();

            if(is_null($employee)){
                return ResponseFormatter::error("Pegawai Tidak Ditemukan!", 404);
            }

            $response = [
                "employee_id" => $employee->employee_id,
                "first_name" => $employee->first_name,
                "last_name" => $employee->last_name,
                "nuptk" => $employee->nuptk,
                "jabatan" => $employee->role,
                "image" => $employee->image,
            ];

            return ResponseFormatter::success($response, 'Get Employee Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getBarcodeSiswa($nisn)
    {
        try{
            $student = Student::join('users', 'students.user_id', '=', 'users.id')->where('nisn', '=',  $nisn)->first();

            if(is_null($student)){
                return ResponseFormatter::error("Siswa Tidak Ditemukan!", 404);
            }

            $response = [
                "student_id" => $student->student_id,
                "first_name" => $student->first_name,
                "last_name" => $student->last_name,
                "nisn" => $student->nisn,
                "jabatan" => $student->role,
                "image" => $student->image,
            ];

            return ResponseFormatter::success($response, 'Get Student Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function postAbsensiPerpusStudent(Request $request)
    {
        try{
            $data = $request->all();
            $timeNow = Carbon::now();
            $return = PerpusAttendance::create([
                "student_id" => $data['student_id'],
                "date" => $timeNow,
                "absensi" => $timeNow
            ]);
            return ResponseFormatter::success( "Succeed Check-in.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function postAbsensiPerpusEmployee(Request $request)
    {
        try{
            $data = $request->all();
            $timeNow = Carbon::now();
            $return = PerpusAttendance::create([
                "employee_id" => $data['employee_id'],
                "date" => $timeNow,
                "absensi" => $timeNow
            ]);
            return ResponseFormatter::success( "Succeed Check-in.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryAbsensiSiswa($date)
    {
        try{
            $absen = PerpusAttendance::join('students', 'perpus_attendances.student_id', '=', 'students.student_id')
                    ->whereNotNull('perpus_attendances.student_id')
                    ->where('date', '=', $date)
                    ->get();

            $response = $absen;

            return ResponseFormatter::success($response, 'Get Absensi Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryAbsensiPegawai($date)
    {
        try{
            $absen = PerpusAttendance::join('employees', 'perpus_attendances.employee_id', '=', 'employees.employee_id')
                    ->whereNotNull('perpus_attendances.employee_id')
                    ->where('date', '=', $date)
                    ->get();

            $response = $absen;

            return ResponseFormatter::success($response, 'Get Absensi Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getRekapAbsensi()
    {
        try{
            // $bymount = PerpusAttendance::all()->groupBy(function($date) {
            //     return Carbon::parse($date->date)->isoFormat('MMMM-YYYY');
            // })->transform(function ($value) { //it can also be map()

            //     $nStr = $value->map(function ($vl) {
            //         return str_replace(".", "", $vl->date);
            //     });
            //     return [
            //         'preco_sum' => $nStr->sum()
            //     ];
            // });

            $bymount =DB::table('perpus_attendances')
                ->select('*',DB::raw('DATE(date) as date'))
                ->get()
                ->groupBy('date');

            $bymount = $bymount->reverse();

            $response = $bymount;

            return ResponseFormatter::success($response, 'Get Rekap Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
