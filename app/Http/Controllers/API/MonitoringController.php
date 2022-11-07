<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Grade;
use App\Models\StudentGrade;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonSchedule;
use App\Models\StudentAttendance;
use App\Models\ExtraSchedule;
use App\Models\Student;
use App\Models\ExtraAttendance;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function getSubject()
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $timeNow = Carbon::now();
            $day = Carbon::parse($timeNow);
            $day->settings(['formatFunction' => 'translatedFormat']);
            $schedule = LessonSchedule::join('subjects', 'lesson_schedules.subject_id', '=', 'subjects.subject_id')
                        ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                        ->where('teacher_id', '=', $employee->employee_id)
                        ->where('day_name', '=', $day->format('l'))
                        ->get([
                            'subjects.subject_id',
                            'subjects.subject_name'
                        ]);

            $response = $schedule;

            return ResponseFormatter::success($response, 'Get Schedule Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getGrade()
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $timeNow = Carbon::now();
            $day = Carbon::parse($timeNow);
            $day->settings(['formatFunction' => 'translatedFormat']);
            $schedule = LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                        ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                        ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                        ->where('day_name', '=', $day->format('l'))
                        ->get([
                            'grades.grade_id',
                            'grades.grade_name'
                        ]);

            $response = $schedule;

            return ResponseFormatter::success($response, 'Get Grade Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAttendance($grade)
    {
        try{
            $attendances = StudentGrade::join('students', 'student_grades.student_id', '=', 'students.student_id')
                        ->where('student_grades.grade_id', '=', $grade)
                        ->get([
                            'students.student_id',
                            'first_name',
                            'last_name',
                            'nisn'
                        ]);

            $fix = [];

            foreach ($attendances as $attendance) {
                array_push($fix, (object)["absensi"=>$attendance, "status"=>"default"]);
            }

            $response = $fix;

            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function addMultiple(Request $request, $grade, $subject)
    {
        try{
            if($request->isMethod('post')){
                $bookData = $request->all();
                $user = Auth::user();
                $timeNow = Carbon::now()->format('H:i:s');
                $employee = Employee::where('user_id', '=', $user->id)->first();
                $day = Carbon::parse($timeNow);
                $day->settings(['formatFunction' => 'translatedFormat']);
                $notScheduleDay = LessonSchedule::join('grades', 'lesson_schedules.grade_id', '=', 'grades.grade_id')
                                ->join('days', 'lesson_schedules.days_id', '=', 'days.day_id')
                                ->where('lesson_schedules.teacher_id', '=', $employee->employee_id)
                                ->where('day_name', '=', $day->format('l'))
                                ->where('lesson_schedules.grade_id', '=', $grade)
                                ->where('lesson_schedules.subject_id', '=', $subject)
                                ->first();

                if($notScheduleDay->start_time > $timeNow ) {
                    return ResponseFormatter::error([], 'Jam Pelajaran Belum Mulai', 400);
                } elseif($timeNow > $notScheduleDay->end_time) {
                    return ResponseFormatter::error([], 'Jam Pelajaran Telah Usai', 400);
                }

                foreach($bookData['books'] as $key => $value){
                    $book = new StudentAttendance;
                    $book->grade_id = $value['grade_id'];
                    $book->student_id = $value['student_id'];
                    $book->subject_id = $value['subject_id'];
                    $book->date = Carbon::now();
                    $book->status = $value['status'];
                    $book->teacher_id = $employee->employee_id;
                    $book->save();
                }
                return ResponseFormatter::success("Succeed Absensi Siswa.");
            }
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistory($date, $subject, $grade)
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $history = StudentAttendance::join('grades', 'student_attendances.grade_id', '=', 'grades.grade_id')
                            ->join('subjects', 'student_attendances.subject_id', '=', 'subjects.subject_id')
                            ->where('student_attendances.teacher_id', '=', $employee->employee_id)
                            ->where('student_attendances.date', '=', $date)
                            ->where('student_attendances.subject_id', '=', $subject)
                            ->where('student_attendances.grade_id', '=', $grade)
                            ->first([
                                'date',
                                'subject_name',
                                'grade_name'
                            ]);

            $historyAttend = StudentAttendance::where('teacher_id', '=', $employee->employee_id)
                            ->where('date', '=', $date)
                            ->where('subject_id', '=', $subject)
                            ->where('grade_id', '=', $grade)
                            ->where('status', '=', 'hadir')
                            ->count();

            $historyAlpha = StudentAttendance::where('teacher_id', '=', $employee->employee_id)
                            ->where('date', '=', $date)
                            ->where('subject_id', '=', $subject)
                            ->where('grade_id', '=', $grade)
                            ->where('status', '=', 'alpha')
                            ->count();

            $historySick = StudentAttendance::where('teacher_id', '=', $employee->employee_id)
                            ->where('date', '=', $date)
                            ->where('subject_id', '=', $subject)
                            ->where('grade_id', '=', $grade)
                            ->where('status', '=', 'sakit')
                            ->count();

            $historyIzin = StudentAttendance::where('teacher_id', '=', $employee->employee_id)
                            ->where('date', '=', $date)
                            ->where('subject_id', '=', $subject)
                            ->where('grade_id', '=', $grade)
                            ->where('status', '=', 'izin')
                            ->count();

            $time = $history->date;
            $test2 =Carbon::parse($history->date);
            $test2->settings(['formatFunction' => 'translatedFormat']);
            $history->date = $test2;

            $response = [
                "date" => $history->date->isoFormat('dddd, D MMMM Y'),
                "grade" => "$history->grade_name",
                "subject" => "$history->subject_name",
                "hadir" => "$historyAttend",
                "alpha" => "$historyAlpha",
                "sakit" => "$historySick",
                "izin" => "$historyIzin"
            ];

            return ResponseFormatter::success($response, 'Get History Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getExtra()
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $timeNow = Carbon::now();
            $day = Carbon::parse($timeNow);
            $day->settings(['formatFunction' => 'translatedFormat']);
            $schedule = ExtraSchedule::join('extracurriculars', 'extra_schedules.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                        ->join('days', 'extra_schedules.days_id', '=', 'days.day_id')
                        ->where('teacher_id', '=', $employee->employee_id)
                        ->where('day_name', '=', $day->format('l'))
                        ->get([
                            'extracurriculars.extracurricular_id',
                            'extracurriculars.extracurricular_name'
                        ]);

            $response = $schedule;

            return ResponseFormatter::success($response, 'Get Schedule Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getAttendExtra($extra)
    {
        try{
            $attendances = Student::join('extracurriculars', 'students.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                        ->where('students.extracurricular_id', '=', $extra)
                        ->get([
                            'students.student_id',
                            'first_name',
                            'last_name',
                            'nisn'
                        ]);

            $fix = [];

            foreach ($attendances as $attendance) {
                array_push($fix, (object)["absensi"=>$attendance, "status"=>"default"]);
            }

            $response = $fix;

            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function addMultipleExtra(Request $request, $extra)
    {
        try{
            if($request->isMethod('post')){
                $bookData = $request->all();
                $user = Auth::user();
                $timeNow = Carbon::now()->format('H:i:s');
                $employee = Employee::where('user_id', '=', $user->id)->first();
                $day = Carbon::parse($timeNow);
                $day->settings(['formatFunction' => 'translatedFormat']);
                $notScheduleDay = ExtraSchedule::join('extracurriculars', 'extra_schedules.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                                ->join('days', 'extra_schedules.days_id', '=', 'days.day_id')
                                ->where('extra_schedules.teacher_id', '=', $employee->employee_id)
                                ->where('day_name', '=', $day->format('l'))
                                ->where('extra_schedules.extracurricular_id', '=', $extra)
                                ->first();

                if($notScheduleDay->start_time > $timeNow ) {
                    return ResponseFormatter::error([], 'Jam Pelajaran Belum Mulai', 400);
                } elseif($timeNow > $notScheduleDay->end_time) {
                    return ResponseFormatter::error([], 'Jam Pelajaran Telah Usai', 400);
                }

                foreach($bookData['books'] as $key => $value){
                    $book = new ExtraAttendance;
                    $book->extracurricular_id = $value['extracurricular_id'];
                    $book->student_id = $value['student_id'];
                    $book->date = Carbon::now();
                    $book->status = $value['status'];
                    $book->teacher_id = $employee->employee_id;
                    $book->save();
                }
                return ResponseFormatter::success("Succeed Absensi Siswa.");
            }
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getHistoryExtra($date, $extra)
    {
        try{
            $user = Auth::user();
            $employee = Employee::where('user_id', '=', $user->id)->first();
            $history = ExtraAttendance::join('extracurriculars', 'extra_attendances.extracurricular_id', '=', 'extracurriculars.extracurricular_id')
                            ->where('extra_attendances.teacher_id', '=', $employee->employee_id)
                            ->where('extra_attendances.date', '=', $date)
                            ->where('extra_attendances.extracurricular_id', '=', $extra)
                            ->first([
                                'date',
                                'extracurricular_name'
                            ]);
            $historyAttend = ExtraAttendance::where('teacher_id', '=', $employee->employee_id)
                            ->where('date', '=', $date)
                            ->where('extracurricular_id', '=', $extra)
                            ->where('status', '=', 'hadir')
                            ->count();

            $historyAlpha = ExtraAttendance::where('teacher_id', '=', $employee->employee_id)
                            ->where('date', '=', $date)
                            ->where('extracurricular_id', '=', $extra)
                            ->where('status', '=', 'alpha')
                            ->count();

            $historySick = ExtraAttendance::where('teacher_id', '=', $employee->employee_id)
                            ->where('date', '=', $date)
                            ->where('extracurricular_id', '=', $extra)
                            ->where('status', '=', 'sakit')
                            ->count();

            $historyIzin = ExtraAttendance::where('teacher_id', '=', $employee->employee_id)
                            ->where('date', '=', $date)
                            ->where('extracurricular_id', '=', $extra)
                            ->where('status', '=', 'izin')
                            ->count();

            $time = $history->date;
            $test2 =Carbon::parse($history->date);
            $test2->settings(['formatFunction' => 'translatedFormat']);
            $history->date = $test2;

            $response = [
                "date" => $history->date->isoFormat('dddd, D MMMM Y'),
                "extracurricular" => "$history->extracurricular_name",
                "hadir" => "$historyAttend",
                "alpha" => "$historyAlpha",
                "sakit" => "$historySick",
                "izin" => "$historyIzin"
            ];

            return ResponseFormatter::success($response, 'Get History Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historySubjectAll()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();
            $attendance = StudentAttendance::where('student_id', '=', $student->student_id)
                        ->get();

            foreach ($attendance as $att) {
                $time = $att->date;
                $test2 = ($att->created_at !== null) ? date('d F Y', strtotime($time)) : '';
                $att->date = $test2;
            }

            $response =  $attendance;
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyExtraAll()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();
            $attendance = ExtraAttendance::where('student_id', '=', $student->student_id)
                        ->get();

            foreach ($attendance as $att) {
                $time = $att->date;
                $test2 = ($att->created_at !== null) ? date('d F Y', strtotime($time)) : '';
                $att->date = $test2;
            }

            $response =  $attendance;
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyAttendanceMapelByWeek()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();
            $attendance = StudentAttendance::where('student_id', '=', $student->student_id)
                        ->orderBy('created_at', 'asc')
                        ->get();

            $week = [];

            foreach ($attendance as $att) {
                $x = Carbon::parse($att->date)->format('W');
                array_push($week, (object)["week"=>$x, "slider"=>1]);
            }

            $unique = collect($week)->unique('week')->values()->all();

            $response = $unique;

            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyAttendanceExtraByWeek()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();
            $attendance = ExtraAttendance::where('student_id', '=', $student->student_id)
                        ->orderBy('created_at', 'asc')
                        ->get();

            $week = [];

            foreach ($attendance as $att) {
                $x = Carbon::parse($att->date)->format('W');
                array_push($week, (object)["week"=>$x, "slider"=>1]);
            }

            $unique = collect($week)->unique('week')->values()->all();

            $response = $unique;

            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function statisticMapel()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();

            $attend = StudentAttendance::where('student_id', '=', $student->student_id)
                        ->where('status', '=', 'hadir')
                        ->count();

            $absence = StudentAttendance::where('student_id', '=', $student->student_id)
                        ->where('status', '=', 'alpha')
                        ->count();

            $sick = StudentAttendance::where('student_id', '=', $student->student_id)
                        ->where('status', '=', 'sakit')
                        ->count();

            $izin = StudentAttendance::where('student_id', '=', $student->student_id)
                        ->where('status', '=', 'izin')
                        ->count();

            $days_work = 120;
            $days_presence_percentages = ($attend / $days_work) * 100;
            $days_absent_percentages = ($absence / $days_work) * 100;
            $days_leave_percentages = ($sick / $days_work) * 100;
            $days_duty_percentages = ($izin / $days_work) * 100;

            $fixAttend = round($days_presence_percentages, 0);
            $fixAbsence = round($days_absent_percentages, 0);
            $fixLeave = round($days_leave_percentages, 0);
            $fixDuty = round($days_duty_percentages, 0);

            $response = [
                "attend" => "$fixAttend",
                "absence" => "$fixAbsence",
                "sick" => "$fixLeave",
                "izin" => "$fixDuty"
            ];
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function statisticExtra()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();

            $attend = ExtraAttendance::where('student_id', '=', $student->student_id)
                        ->where('status', '=', 'hadir')
                        ->count();

            $absence = ExtraAttendance::where('student_id', '=', $student->student_id)
                        ->where('status', '=', 'alpha')
                        ->count();

            $sick = ExtraAttendance::where('student_id', '=', $student->student_id)
                        ->where('status', '=', 'sakit')
                        ->count();

            $izin = ExtraAttendance::where('student_id', '=', $student->student_id)
                        ->where('status', '=', 'izin')
                        ->count();

            $days_work = 120;
            $days_presence_percentages = ($attend / $days_work) * 100;
            $days_absent_percentages = ($absence / $days_work) * 100;
            $days_leave_percentages = ($sick / $days_work) * 100;
            $days_duty_percentages = ($izin / $days_work) * 100;

            $fixAttend = round($days_presence_percentages, 0);
            $fixAbsence = round($days_absent_percentages, 0);
            $fixLeave = round($days_leave_percentages, 0);
            $fixDuty = round($days_duty_percentages, 0);

            $response = [
                "attend" => "$fixAttend",
                "absence" => "$fixAbsence",
                "sick" => "$fixLeave",
                "izin" => "$fixDuty"
            ];
            return ResponseFormatter::success($response, 'Get Attendance Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
