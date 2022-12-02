<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\AdmissionController;
use App\Http\Controllers\API\LessonScheduleController;
use App\Http\Controllers\API\ExtraController;
use App\Http\Controllers\API\MonitoringController;
use App\Http\Controllers\API\FacilityController;
use App\Http\Controllers\API\AssessmentController;
use App\Http\Controllers\API\RaporController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\ExtraAssessmentController;
use App\Http\Controllers\API\MutasiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('users')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot', [AuthController::class, 'forgot']);
    Route::post('/otp', [AuthController::class, 'getOtp']);
    Route::post('/reset', [AuthController::class, 'updatePass']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/registerstudent', [AuthController::class, 'registerStudent']);
        Route::post('/registeremployee', [AuthController::class, 'registerEmployee']);
        Route::post('/registerguardian', [AuthController::class, 'registerGuardian']);
        Route::get('/profile', [ProfileController::class, 'getProfile']);
        Route::get('/student', [ProfileController::class, 'getDataStudent']);
        Route::get('/guardian', [ProfileController::class, 'getGuardian']);
        Route::post('/changepass', [AuthController::class, 'changePassword']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'getAllNews']);
        Route::post('/addnews', [NewsController::class, 'addNews']);
        Route::post('/{id}', [NewsController::class, 'updateNews']);
        Route::delete('/{id}', [NewsController::class, 'deleteNews']);
    });

    Route::prefix('attendances')->group(function () {
        Route::post('/addleave', [AttendanceController::class, 'addLeave']);
        Route::post('/addduty', [AttendanceController::class, 'addDuty']);
        Route::post('/checkin', [AttendanceController::class, 'checkIn']);
        Route::post('/checkout', [AttendanceController::class, 'checkOut']);
        Route::get('/gettype', [AttendanceController::class, 'getLeaveType']);
        Route::get('/history', [AttendanceController::class, 'historyAttendance']);
        Route::get('/historyall', [AttendanceController::class, 'historyAll']);
        Route::get('/statistic', [AttendanceController::class, 'statistic']);
    });

    Route::prefix('admission')->group(function () {
        Route::post('/addemployee', [AdmissionController::class, 'addEmployee']);
        Route::post('/addstudent', [AdmissionController::class, 'addStudent']);
        Route::get('/getstudent', [AdmissionController::class, 'getStudent']);
        Route::get('/getemployee', [AdmissionController::class, 'getEmployee']);
        Route::post('/updatestudent/{id}', [AdmissionController::class, 'updateStudent']);
        Route::post('/updateemployee/{id}', [AdmissionController::class, 'updateEmployee']);
        Route::get('/getshift', [AdmissionController::class, 'getShift']);
    });

    Route::prefix('lessonschedule')->group(function () {
        Route::get('/getschedule/{grade}', [LessonScheduleController::class, 'getSchedule']);
        Route::get('/getschedule/{grade}/{day}', [LessonScheduleController::class, 'getByDay']);
        Route::get('/getday', [LessonScheduleController::class, 'getDay']);
        Route::get('/getgrade', [LessonScheduleController::class, 'getGrade']);
        Route::get('/getsubject', [LessonScheduleController::class, 'getSubject']);
        Route::get('/getteacher', [LessonScheduleController::class, 'getTeacher']);
        Route::post('/updateschedule/{id}', [LessonScheduleController::class, 'editSchedule']);
        Route::get('/getlessonteacher', [LessonScheduleController::class, 'getScheduleByTeacher']);
        Route::get('/getlessonteacher/{day}', [LessonScheduleController::class, 'getScheduleByDay']);
        Route::get('/getlesson/{subject}', [LessonScheduleController::class, 'getScheduleBySubject']);
        Route::get('/getworkday/{day}', [LessonScheduleController::class, 'getWorkday']);
        Route::post('/updateworkday/{id}', [LessonScheduleController::class, 'editWorkday']);
        Route::get('/getwork', [LessonScheduleController::class, 'getWork']);
        Route::get('/getemployee', [LessonScheduleController::class, 'getEmployee']);
        Route::get('/getshift', [LessonScheduleController::class, 'getShift']);
        Route::get('/getworkbyemployee', [LessonScheduleController::class, 'getWorkByEmployee']);
        Route::get('/getworkemployeebyday/{day}', [LessonScheduleController::class, 'getWorkEmployeeByDay']);
    });

    Route::prefix('extraschedule')->group(function () {
        Route::get('/getschedule/{extra}', [ExtraController::class, 'getScheduleExtra']);
        Route::get('/getschedule/{extra}/{day}', [ExtraController::class, 'getByDayExtra']);
        Route::get('/getextra', [ExtraController::class, 'getExtra']);
        Route::post('/updateschedule/{id}', [ExtraController::class, 'updateExtra']);
        Route::get('/getpembina', [ExtraController::class, 'getPembina']);
    });

    Route::prefix('monitoring')->group(function () {
        Route::get('/getsubject', [MonitoringController::class, 'getSubject']);
        Route::get('/getgrade', [MonitoringController::class, 'getGrade']);
        Route::get('/getattendance/{grade}', [MonitoringController::class, 'getAttendance']);
        Route::get('/gethistory/{date}/{subject}/{grade}', [MonitoringController::class, 'getHistory']);
        Route::get('/gethistoryextra/{date}/{extra}', [MonitoringController::class, 'getHistoryExtra']);
        Route::post('/postattendance/{grade}/{subject}', [MonitoringController::class, 'addMultiple']);
        Route::post('/post/{extra}', [MonitoringController::class, 'addMultipleExtra']);
        Route::get('/getextra', [MonitoringController::class, 'getExtra']);
        Route::get('/getattendextra/{extra}', [MonitoringController::class, 'getAttendExtra']);
        Route::get('/getsubjectall', [MonitoringController::class, 'historySubjectAll']);
        Route::get('/getextraall', [MonitoringController::class, 'historyExtraAll']);
        Route::get('/historymapel', [MonitoringController::class, 'historyAttendanceMapelByWeek']);
        Route::get('/historyextra', [MonitoringController::class, 'historyAttendanceExtraByWeek']);
        Route::get('/statisticmapel', [MonitoringController::class, 'statisticMapel']);
        Route::get('/statisticextra', [MonitoringController::class, 'statisticExtra']);
        Route::get('/getday/{id}', [MonitoringController::class, 'getGradeById']);
        Route::get('/getsubject/{id}', [MonitoringController::class, 'getSubjectById']);
        Route::get('/getextra/{id}', [MonitoringController::class, 'getExtraById']);
    });

    Route::prefix('facility')->group(function () {
        Route::post('/create', [FacilityController::class, 'createFacility']);
        Route::delete('/delete/{id}', [FacilityController::class, 'deleteFacility']);
        Route::post('/update/{id}', [FacilityController::class, 'editFacility']);
        Route::get('/', [FacilityController::class, 'getAllFacility']);
        Route::get('/getfacility', [FacilityController::class, 'getFacility']);
        Route::get('/getloanstudent', [FacilityController::class, 'getAllLoanStudent']);
        Route::get('/getloanemployee', [FacilityController::class, 'getAllLoanEmployee']);
        Route::get('/getreturn', [FacilityController::class, 'getFacilityOngoing']);
        Route::get('/getreturnemployee', [FacilityController::class, 'getAllReturnEmployee']);
        Route::get('/getreturnstudent', [FacilityController::class, 'getAllReturnStudent']);
        Route::get('/historytuemployee', [FacilityController::class, 'historyTuEmployee']);
        Route::get('/historytustudent', [FacilityController::class, 'historyTuStudent']);
        Route::get('/historybyuser', [FacilityController::class, 'historyByUser']);
        Route::get('/getallfacility', [FacilityController::class, 'getFacilityDefault']);
        Route::get('/{code}', [FacilityController::class, 'getFacilityByCode']);
        Route::get('/getfacility/{id}', [FacilityController::class, 'getFacilityById']);
        Route::post('/createloan', [FacilityController::class, 'createLoan']);
        Route::post('/updateloan/{id}', [FacilityController::class, 'approvalLoan']);
        Route::post('/pendingreturn/{id}', [FacilityController::class, 'pendingReturn']);
        Route::post('/return/{id}', [FacilityController::class, 'returned']);
        Route::post('/updatediknas', [FacilityController::class, 'updateMultiple']);
    });

    Route::prefix('assessment')->group(function () {
        Route::get('/getsemester', [AssessmentController::class, 'getSemester']);
        Route::get('/getsubject', [AssessmentController::class, 'getSubjectAll']);
        Route::get('/getgrade', [AssessmentController::class, 'getGradeAll']);
        Route::get('/getsemester/{id}', [AssessmentController::class, 'getSemesterById']);
        Route::get('/getassessment', [AssessmentController::class, 'getAssessment']);
        Route::get('/getassessment/{id}', [AssessmentController::class, 'getAssessmentById']);
        Route::get('/getstudent/{grade}', [AssessmentController::class, 'getStudent']);
        Route::post('/addpenilaian', [AssessmentController::class, 'addPenilaian']);
        Route::post('/updatepenilaian/{id}', [AssessmentController::class, 'editPenilaian']);
        Route::get('/getnilai/{grade}/{subject}/{semester}/{assessment}', [AssessmentController::class, 'getNilai']);
        Route::get('/getacademic', [AssessmentController::class, 'getAcademic']);
        Route::get('/getgradeforstudent', [AssessmentController::class, 'getGradeForStudent']);
        Route::get('/gethistory/{grade}/{semester}/{academic}/{subject}', [AssessmentController::class, 'getHistoryPenilaian']);
    });

    Route::prefix('rapor')->group(function () {
        Route::get('/getrapor/{grade}', [RaporController::class, 'getStudent']);
        Route::post('/updaterapor/{student}/{semester}/{academic}/{subject}/{grade}', [RaporController::class, 'raporConfirm']);
        Route::get('/getacademic/{academic}', [RaporController::class, 'getAcademicById']);
        Route::get('/getnilai/{student}/{grade}/{semester}/{academic}/{subject}', [RaporController::class, 'getFixNilai']);
        Route::get('/getgrade', [RaporController::class, 'getNilaiForConfirm']);
        Route::post('/editrapor/{grade}', [RaporController::class, 'updateStatusKepsek']);
        Route::get('/getraporbyuser/{grade}/{semester}/{academic}', [RaporController::class, 'getRapor']);
        Route::get('/getstudentbykepsek/{grade}', [RaporController::class, 'getStudentForKepsek']);
        Route::get('/gethistorykepsek', [RaporController::class, 'getHistoryKepsek']);
    });

    Route::prefix('data')->group(function () {
        Route::get('/getstudent', [StudentController::class, 'getDataStudent']);
        Route::get('/getstudent/{student}', [StudentController::class, 'getDataStudentByName']);
        Route::get('/getemployeebyname/{employee}', [StudentController::class, 'getDataEmployeeByName']);
        Route::get('/getemployee', [StudentController::class, 'getDataEmployee']);
        Route::get('/history/{employee}', [StudentController::class, 'historyAttendance']);
        Route::get('/historyall/{employee}', [StudentController::class, 'historyAll']);
        Route::get('/statistic/{employee}', [StudentController::class, 'statistic']);
        Route::get('/getemployee/{employee}', [StudentController::class, 'getEmployee']);
        Route::get('/getsubjectall/{student}', [StudentController::class, 'historySubjectAll']);
        Route::get('/historymapel/{student}', [StudentController::class, 'historyAttendanceMapelByWeek']);
        Route::get('/statisticmapel/{student}', [StudentController::class, 'statisticMapel']);
        Route::get('/getstudentbyid/{student}', [StudentController::class, 'getStudent']);
        Route::get('/getraporbyuser/{student}', [StudentController::class, 'getRapor']);
    });

    Route::prefix('assessmentextra')->group(function () {
        Route::get('/getstudent', [ExtraAssessmentController::class, 'getStudent']);
        Route::post('/addpenilaian', [ExtraAssessmentController::class, 'addPenilaian']);
        Route::post('/updatepenilaian/{id}', [ExtraAssessmentController::class, 'editPenilaian']);
    });

    Route::prefix('mutasi')->group(function () {
        Route::post('/add', [MutasiController::class, 'createMutasi']);
        Route::get('/historywalmur', [MutasiController::class, 'historyMutasiWalMur']);
        Route::get('/historysiswa', [MutasiController::class, 'historyMutasiSiswa']);
        Route::get('/data/{awal}/{akhir}', [MutasiController::class, 'getDataForKonfirmasi']);
        Route::get('/history/{awal}/{akhir}', [MutasiController::class, 'getDataHistory']);
    });
});
