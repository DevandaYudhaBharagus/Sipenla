<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Mutasi;
use App\Models\Guardian;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MutasiController extends Controller
{
    public function createMutasi(Request $request)
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();
            $data = $request->all();

            $validate = Validator::make($data, [
                'to_school' => 'required',
                'letter_school_transfer' => 'required|mimes:pdf',
                'letter_ijazah' => 'required|mimes:pdf',
                'letter_no_sanksi' => 'required|mimes:pdf',
                'letter_recom_diknas' => 'required|mimes:pdf',
                'kartu_keluarga' => 'required|mimes:pdf',
                'surat_keterangan_pindah_sekolah' => 'required|mimes:pdf',
            ]);

            if ($validate->fails()) {
                $response = [
                    'errors' => $validate->errors()
                ];

                return ResponseFormatter::error($response, 'Bad Request', 400);
            }

            if ($request->file('letter_school_transfer')) {
                $test['letter_school_transfer'] = $request->file('letter_school_transfer')->store('letter_school_transfer');
            }

            if ($request->file('rapor')) {
                $test['rapor'] = $request->file('rapor')->store('rapor');
            }

            if ($request->file('letter_ijazah')) {
                $test['letter_ijazah'] = $request->file('letter_ijazah')->store('letter_ijazah');
            }

            if ($request->file('letter_no_sanksi')) {
                $test['letter_no_sanksi'] = $request->file('letter_no_sanksi')->store('letter_no_sanksi');
            }

            if ($request->file('letter_recom_diknas')) {
                $test['letter_recom_diknas'] = $request->file('letter_recom_diknas')->store('letter_recom_diknas');
            }

            if ($request->file('kartu_keluarga')) {
                $test['kartu_keluarga'] = $request->file('kartu_keluarga')->store('kartu_keluarga');
            }

            if ($request->file('surat_keterangan_pindah_sekolah')) {
                $test['surat_keterangan_pindah_sekolah'] = $request->file('surat_keterangan_pindah_sekolah')->store('surat_keterangan_pindah_sekolah');
            }

            $mutasiData = Mutasi::create([
                'student_id' => $student->student_id,
                'to_school' => $data['to_school'],
                'letter_school_transfer' => $test['letter_school_transfer'],
                'rapor' => $test['rapor'],
                'letter_ijazah' => $test['letter_ijazah'],
                'letter_no_sanksi' => $test['letter_no_sanksi'],
                'letter_recom_diknas' => $test['letter_recom_diknas'],
                'kartu_keluarga' => $test['kartu_keluarga'],
                'surat_keterangan_pindah_sekolah' => $test['surat_keterangan_pindah_sekolah'],
                'status' => "pending",
            ]);

            return ResponseFormatter::success( "Succeed added Mutasi Data.");
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyMutasiSiswa()
    {
        try{
            $user = Auth::user();
            $student = Student::where('user_id', '=', $user->id)->first();
            $history = Mutasi::join('students', 'mutasis.student_id', '=', 'students.student_id')
                    ->where('mutasis.student_id', '=', $student->student_id)
                    ->orderBy('mutasis.created_at', 'desc')
                    ->get([
                        "mutasis.mutasi_id",
                        "mutasis.student_id",
                        "mutasis.to_school",
                        "mutasis.letter_school_transfer",
                        "mutasis.rapor",
                        "mutasis.letter_ijazah",
                        "mutasis.letter_no_sanksi",
                        "mutasis.letter_recom_diknas",
                        "mutasis.kartu_keluarga",
                        "mutasis.surat_keterangan_pindah_sekolah",
                        "mutasis.status",
                        "mutasis.created_at",
                        "mutasis.updated_at",
                        "students.first_name",
                        "students.last_name",
                        "students.nisn",
                        "students.place_of_birth",
                        "students.date_of_birth",
                        "students.father_name",
                        "students.mother_name",
                        "students.gender",
                        "students.phone",
                        "students.date_school_now",
                        "students.address",
                        "students.religion",
                        "students.school_origin",
                        "students.school_now",
                        "students.parent_address",
                        "students.mother_profession",
                        "students.father_profession",
                        "students.mother_education",
                        "students.father_education",
                        "students.family_name",
                        "students.family_address",
                        "students.family_profession",
                        "students.extracurricular_id",
                        "students.image",
                    ]);

            foreach ($history as $h) {
                $time = $h->created_at;
                $test2 = Carbon::parse($time)->format('d F Y');
                $h->tanggal = $test2;
            }

            $response = $history;

            return ResponseFormatter::success($response, 'Get History Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function historyMutasiWalMur()
    {
        try{
            $user = Auth::user();
            $walmur = Guardian::where('user_id', '=', $user->id)->first();
            $history = Mutasi::join('students', 'mutasis.student_id', '=', 'students.student_id')
                    ->where('mutasis.student_id', '=', $walmur->student_id)
                    ->orderBy('mutasis.created_at', 'desc')
                    ->get([
                        "mutasis.mutasi_id",
                        "mutasis.student_id",
                        "mutasis.to_school",
                        "mutasis.letter_school_transfer",
                        "mutasis.rapor",
                        "mutasis.letter_ijazah",
                        "mutasis.letter_no_sanksi",
                        "mutasis.letter_recom_diknas",
                        "mutasis.kartu_keluarga",
                        "mutasis.surat_keterangan_pindah_sekolah",
                        "mutasis.status",
                        "mutasis.created_at",
                        "mutasis.updated_at",
                        "students.first_name",
                        "students.last_name",
                        "students.nisn",
                        "students.place_of_birth",
                        "students.date_of_birth",
                        "students.father_name",
                        "students.mother_name",
                        "students.gender",
                        "students.phone",
                        "students.date_school_now",
                        "students.address",
                        "students.religion",
                        "students.school_origin",
                        "students.school_now",
                        "students.parent_address",
                        "students.mother_profession",
                        "students.father_profession",
                        "students.mother_education",
                        "students.father_education",
                        "students.family_name",
                        "students.family_address",
                        "students.family_profession",
                        "students.extracurricular_id",
                        "students.image",
                    ]);

            foreach ($history as $h) {
                $time = $h->created_at;
                $test2 = Carbon::parse($time)->format('d F Y');
                $h->tanggal = $test2;
            }

            $response = $history;

            return ResponseFormatter::success($response, 'Get History Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getDataForKonfirmasi($awal, $akhir)
    {
        try{
            $data = Mutasi::join('students', 'mutasis.student_id', '=', 'students.student_id')
                    ->whereDate('mutasis.created_at', '>=', $awal)
                    ->whereDate('mutasis.created_at', '<=', $akhir)
                    ->where('mutasis.status', '=', 'pending')
                    ->orderBy('mutasis.created_at', 'desc')
                    ->get([
                        "mutasis.mutasi_id",
                        "mutasis.student_id",
                        "mutasis.to_school",
                        "mutasis.letter_school_transfer",
                        "mutasis.rapor",
                        "mutasis.letter_ijazah",
                        "mutasis.letter_no_sanksi",
                        "mutasis.letter_recom_diknas",
                        "mutasis.kartu_keluarga",
                        "mutasis.surat_keterangan_pindah_sekolah",
                        "mutasis.status",
                        "mutasis.created_at",
                        "mutasis.updated_at",
                        "students.first_name",
                        "students.last_name",
                        "students.nisn",
                        "students.place_of_birth",
                        "students.date_of_birth",
                        "students.father_name",
                        "students.mother_name",
                        "students.gender",
                        "students.phone",
                        "students.date_school_now",
                        "students.address",
                        "students.religion",
                        "students.school_origin",
                        "students.school_now",
                        "students.parent_address",
                        "students.mother_profession",
                        "students.father_profession",
                        "students.mother_education",
                        "students.father_education",
                        "students.family_name",
                        "students.family_address",
                        "students.family_profession",
                        "students.extracurricular_id",
                        "students.image",
                    ]);

            $response = $data;

            return ResponseFormatter::success($response, 'Get History Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function getDataHistory($awal, $akhir)
    {
        try{
            $data = Mutasi::join('students', 'mutasis.student_id', '=', 'students.student_id')
                    ->whereDate('mutasis.created_at', '>=', $awal)
                    ->whereDate('mutasis.created_at', '<=', $akhir)
                    ->whereNotIn('mutasis.status', ['pending'])
                    ->orderBy('mutasis.created_at', 'desc')
                    ->get([
                        "mutasis.mutasi_id",
                        "mutasis.student_id",
                        "mutasis.to_school",
                        "mutasis.letter_school_transfer",
                        "mutasis.rapor",
                        "mutasis.letter_ijazah",
                        "mutasis.letter_no_sanksi",
                        "mutasis.letter_recom_diknas",
                        "mutasis.kartu_keluarga",
                        "mutasis.surat_keterangan_pindah_sekolah",
                        "mutasis.status",
                        "mutasis.created_at",
                        "mutasis.updated_at",
                        "students.first_name",
                        "students.last_name",
                        "students.nisn",
                        "students.place_of_birth",
                        "students.date_of_birth",
                        "students.father_name",
                        "students.mother_name",
                        "students.gender",
                        "students.phone",
                        "students.date_school_now",
                        "students.address",
                        "students.religion",
                        "students.school_origin",
                        "students.school_now",
                        "students.parent_address",
                        "students.mother_profession",
                        "students.father_profession",
                        "students.mother_education",
                        "students.father_education",
                        "students.family_name",
                        "students.family_address",
                        "students.family_profession",
                        "students.extracurricular_id",
                        "students.image",
                    ]);

            $response = $data;

            return ResponseFormatter::success($response, 'Get History Success');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateKonfirmasi($id)
    {
        try{
            $edit = [
                "status" => "konfirmasi"
            ];

            $editStudent = [
                "status" => "inactive"
            ];

            $student = Mutasi::where('mutasi_id', '=', $id)
                        ->first();

            $updateMutasi = Mutasi::where('mutasi_id', '=', $id)
                            ->update($edit);

            $updateStudent = Student::where('student_id', '=', $student->student_id)
                            ->update($editStudent);

            return ResponseFormatter::success('Sukses Mengapprove Mutasi');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }

    public function updateCancel($id)
    {
        try{
            $edit = [
                "status" => "cancel"
            ];

            $updateMutasi = Mutasi::where('mutasi_id', '=', $id)
                            ->update($edit);

            return ResponseFormatter::success('Sukses Cancel Mutasi');
        }catch (Exception $e) {
            $response = [
                'errors' => $e->getMessage(),
            ];
            return ResponseFormatter::error($response, 'Something went wrong', 500);
        }
    }
}
