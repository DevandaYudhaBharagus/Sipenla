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
use App\Http\Controllers\API\PerpustakaanController;
use App\Http\Controllers\API\TopupController;
use App\Http\Controllers\API\PayoutController;
use App\Http\Controllers\API\FineController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\WithdrawalController;
use App\Http\Controllers\API\OtherPaymentController;
use App\Http\Controllers\API\SchoolFeeController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\KantinController;

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
        Route::get('/getnilai/{academic}/{semester}', [ExtraAssessmentController::class, 'getNilai']);
        Route::post('/addpenilaian', [ExtraAssessmentController::class, 'addPenilaian']);
        Route::post('/updatepenilaian/{id}', [ExtraAssessmentController::class, 'editPenilaian']);
    });

    Route::prefix('mutasi')->group(function () {
        Route::post('/add', [MutasiController::class, 'createMutasi']);
        Route::post('/update/{id}', [MutasiController::class, 'updateKonfirmasi']);
        Route::post('/cancel/{id}', [MutasiController::class, 'updateCancel']);
        Route::get('/historywalmur', [MutasiController::class, 'historyMutasiWalMur']);
        Route::get('/historysiswa', [MutasiController::class, 'historyMutasiSiswa']);
        Route::get('/data/{awal}/{akhir}', [MutasiController::class, 'getDataForKonfirmasi']);
        Route::get('/history/{awal}/{akhir}', [MutasiController::class, 'getDataHistory']);
    });

    Route::prefix('perpus')->group(function () {
        Route::post('/addbook', [PerpustakaanController::class, 'addBook']);
        Route::get('/getbook', [PerpustakaanController::class, 'getBook']);
        Route::get('/getbook/{code}', [PerpustakaanController::class, 'getBookByCode']);
        Route::get('/book/{id}', [PerpustakaanController::class, 'getBookById']);
        Route::post('/updatebook/{id}', [PerpustakaanController::class, 'updateBook']);
        Route::delete('/deletebook/{id}', [PerpustakaanController::class, 'deleteBook']);
        Route::post('/createloan', [PerpustakaanController::class, 'createLoan']);
        Route::get('/getloanstudent', [PerpustakaanController::class, 'getAllLoanStudent']);
        Route::get('/getloanemployee', [PerpustakaanController::class, 'getAllLoanEmployee']);
        Route::post('/updateloan/{id}', [PerpustakaanController::class, 'approvalLoan']);
        Route::get('/getreturn', [PerpustakaanController::class, 'getBookOngoing']);
        Route::post('/pendingreturn/{id}', [PerpustakaanController::class, 'pendingReturn']);
        Route::post('/pendingreturndenda/{id}', [PerpustakaanController::class, 'pendingReturnDenda']);
        Route::get('/getreturnemployee', [PerpustakaanController::class, 'getAllReturnEmployee']);
        Route::get('/getreturnstudent', [PerpustakaanController::class, 'getAllReturnStudent']);
        Route::post('/return/{id}', [PerpustakaanController::class, 'returned']);
        Route::post('/addsumbangan', [PerpustakaanController::class, 'createSumbangBuku']);
        Route::get('/getsumbanganstudent', [PerpustakaanController::class, 'getListSumbanganStudent']);
        Route::get('/getsumbanganemployee', [PerpustakaanController::class, 'getListSumbanganEmployee']);
        Route::post('/approvebook/{id}', [PerpustakaanController::class, 'approveSumbangan']);
        Route::post('/rejectbook/{id}', [PerpustakaanController::class, 'rejectSumbangan']);
        Route::post('/rejectloan/{id}', [PerpustakaanController::class, 'rejectPengajuan']);
        Route::get('/historybyuser', [PerpustakaanController::class, 'getHistoryForUser']);
        Route::get('/historysumbangbyuser', [PerpustakaanController::class, 'getHistorySumbangForUser']);
        Route::get('/historyemployee/{date}', [PerpustakaanController::class, 'getHistoryPeminjamanEmployee']);
        Route::get('/historystudent/{date}', [PerpustakaanController::class, 'getHistoryPeminjamanStudent']);
        Route::get('/historysumbangstudent/{date}', [PerpustakaanController::class, 'getHistorySumbangStudent']);
        Route::get('/historysumbangemployee/{date}', [PerpustakaanController::class, 'getHistorySumbangEmployee']);
        Route::get('/scanemployee/{nuptk}', [PerpustakaanController::class, 'getBarcodePegawai']);
        Route::get('/scanstudent/{nisn}', [PerpustakaanController::class, 'getBarcodeSiswa']);
        Route::post('/postabsenstudent', [PerpustakaanController::class, 'postAbsensiPerpusStudent']);
        Route::post('/postabsenemployee', [PerpustakaanController::class, 'postAbsensiPerpusEmployee']);
        Route::get('/historyabsenstudent/{date}', [PerpustakaanController::class, 'getHistoryAbsensiSiswa']);
        Route::get('/historyabsenemployee/{date}', [PerpustakaanController::class, 'getHistoryAbsensiPegawai']);
        Route::get('/rekap', [PerpustakaanController::class, 'getRekapAbsensi']);
    });

    Route::prefix('topup')->group(function () {
        Route::post('/add', [TopupController::class, 'updateSaldo']);
        Route::post('/code', [TopupController::class, 'checkCode']);
        Route::post('/updatebalance/{code}', [TopupController::class, 'approveSaldo']);
        Route::post('/rejectbalance/{code}', [TopupController::class, 'rejectSaldo']);
        Route::get('/getsaldo', [TopupController::class, 'getSaldoUser']);
        Route::get('/gethistory/{tanggal}', [TopupController::class, 'getHistory']);
        Route::get('/getriwayat/{tanggal}', [TopupController::class, 'getDataSiswa']);
        Route::get('/getriwayatpegawai/{tanggal}', [TopupController::class, 'getDataPegawai']);
    });

    Route::prefix('payout')->group(function () {
        Route::post('/add', [PayoutController::class, 'makePayout']);
        Route::post('/approve/{code}', [PayoutController::class, 'approvePayout']);
        Route::post('/reject/{code}', [PayoutController::class, 'rejectPayout']);
        Route::get('/getconfirmsiswa', [PayoutController::class, 'getDataSiswa']);
        Route::get('/getconfirmpegawai', [PayoutController::class, 'getDataPegawai']);
        Route::get('/getriwayatsiswa/{tanggal}', [PayoutController::class, 'getHistorySiswa']);
        Route::get('/getriwayatpegawai/{tanggal}', [PayoutController::class, 'getHistoryPegawai']);
        Route::get('/getpayout/{tanggal}', [PayoutController::class, 'getHistory']);
    });

    Route::prefix('fine')->group(function () {
        Route::get('/history/{tanggal}', [FineController::class, 'getHistory']);
    });

    Route::prefix('payment')->group(function () {
        Route::post('/', [PaymentController::class, 'testPayment']);
        Route::get('/status/{orderID}', [PaymentController::class, 'getStatus']);
        Route::post('/updatebalance', [PaymentController::class, 'updateBalance']);
        Route::post('/updatesaving', [PaymentController::class, 'updateSaving']);
        Route::post('/update/{orderid}', [PaymentController::class, 'updateStatus']);
        Route::get('/historytopup/{tanggal}', [PaymentController::class, 'getHistoryTopup']);
        Route::get('/historytabungan/{tanggal}', [PaymentController::class, 'getHistorySaving']);
        Route::get('/historyadmlain/{tanggal}', [PaymentController::class, 'getHistoryOtherPayment']);
        Route::get('/historyspp/{tanggal}', [PaymentController::class, 'getHistorySpp']);
        Route::get('/historybyuser', [PaymentController::class, 'getHistoryByUser']);
    });

    Route::prefix('saving')->group(function () {
        Route::post('/', [WithdrawalController::class, 'makeWithdrawal']);
        Route::get('/getsiswa', [WithdrawalController::class, 'getDataSiswa']);
        Route::get('/getpegawai', [WithdrawalController::class, 'getDataPegawai']);
        Route::post('/approve/{code}', [WithdrawalController::class, 'approveWithdrawal']);
        Route::post('/reject/{code}', [WithdrawalController::class, 'rejectWithdrawal']);
        Route::get('/getriwayatsiswa/{tanggal}', [WithdrawalController::class, 'getHistorySiswa']);
        Route::get('/getriwayatpegawai/{tanggal}', [WithdrawalController::class, 'getHistoryPegawai']);
        Route::get('/getsaldosaving', [WithdrawalController::class, 'getSaldoSaving']);
        Route::get('/gethistory/{tanggal}', [WithdrawalController::class, 'getHistory']);
        Route::get('/getstatus', [WithdrawalController::class, 'getStatusSaving']);
        Route::post('/updatestatus/{id}', [WithdrawalController::class, 'updateStatus']);
    });

    Route::prefix('bill')->group(function () {
        Route::post('/', [OtherPaymentController::class, 'createTagihan']);
        Route::get('/', [OtherPaymentController::class, 'getTagihan']);
        Route::get('/bydate', [OtherPaymentController::class, 'getTagihanByDate']);
    });

    Route::prefix('schoolfee')->group(function () {
        Route::post('/', [SchoolFeeController::class, 'createTagihan']);
        Route::get('/', [SchoolFeeController::class, 'getTagihan']);
        Route::get('/bydate', [SchoolFeeController::class, 'getTagihanByDate']);
    });

    Route::prefix('chat')->group(function () {
        Route::get('/room', [ChatController::class, 'listRoom']);
        Route::get('/chat/{room}', [ChatController::class, 'readChat']);
        Route::get('/roomuser', [ChatController::class, 'listRoomByIdUser']);
        Route::post('/', [ChatController::class, 'createChat']);
        Route::post('/update/{room}', [ChatController::class, 'updateChat']);
        Route::post('/status/{room}', [ChatController::class, 'updateStatusChat']);
    });

    Route::prefix('notif')->group(function () {
        Route::get('/', [NotificationController::class, 'getNotif']);
    });

    Route::prefix('kantin')->group(function () {
        Route::get('/transaction', [KantinController::class, 'getHistoryByUser']);
        Route::post('/', [KantinController::class, 'createKantin']);
        Route::get('/pegawai', [KantinController::class, 'getPegawai']);
        Route::get('/{kode}', [KantinController::class, 'getScan']);
        Route::get('/', [KantinController::class, 'getKantin']);
        Route::post('/transaction/{employee_id}', [KantinController::class, 'createTransaction']);
    });
});
