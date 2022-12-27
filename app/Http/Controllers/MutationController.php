<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMutation;
use App\Models\Mutasi;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MutationController extends Controller
{
    protected function saveImage($file, $path='public')
    {
        if (!$file) {
            return null;
        }

        $filename = time() . '.pdf';
        // save file
        Storage::disk($path)->put($filename, base64_decode($file));

        //return the path
        // Url is the base url exp: localhost:8000
        $urls = env("AZURE_STORAGE_URL") . env("AZURE_STORAGE_CONTAINER") . "/" . $filename;
        return $urls;
    }

    public function index()
    {
        $mutasi = Mutasi::where("student_id", auth()->user()->student->student_id)->get();
        return view('pages.mutasi.index', compact('mutasi'));
    }

    public function create()
    {
        $student = Student::where("user_id", auth()->user()->id)->first();
        return view('pages.mutasi.create', compact('student'));
    }

    public function insert(CreateMutation $request)
    {
        $validated = $request->validated();
        try {
            $letterSchoolTransfer = base64_encode(file_get_contents($request->file('letter_school_transfer')->path()));
            $letterSchoolTransferUrl = $this->saveImage($letterSchoolTransfer, "azure");
            $rapor = base64_encode(file_get_contents($request->file('rapor')->path()));
            $raporUrl = $this->saveImage($rapor, "azure");
            $letterIjazah = base64_encode(file_get_contents($request->file('letter_ijazah')->path()));
            $letterIjazahUrl = $this->saveImage($letterIjazah, "azure");
            $letterNoSanksi = base64_encode(file_get_contents($request->file('letter_no_sanksi')->path()));
            $letterNoSanksiUrl = $this->saveImage($letterNoSanksi, "azure");
            $letterRecomDiknas = base64_encode(file_get_contents($request->file('letter_recom_diknas')->path()));
            $letterRecomDiknasUrl = $this->saveImage($letterRecomDiknas, "azure");
            $kartuKeluarga = base64_encode(file_get_contents($request->file('kartu_keluarga')->path()));
            $kartuKeluargaUrl = $this->saveImage($kartuKeluarga, "azure");
            $suratKeteranganPindahSekolah = base64_encode(file_get_contents($request->file('surat_keterangan_pindah_sekolah')->path()));
            $suratKeteranganPindahSekolahUrl = $this->saveImage($suratKeteranganPindahSekolah, "azure");
            Mutasi::create([
                'student_id'=>auth()->user()->student->student_id,
                'to_school'=>$validated["to_school"],
                "letter_school_transfer"=>$letterSchoolTransferUrl,
                "rapor"=>$raporUrl,
                "letter_ijazah"=>$letterIjazahUrl,
                "letter_no_sanksi"=>$letterNoSanksiUrl,
                "letter_recom_diknas"=>$letterRecomDiknasUrl,
                "kartu_keluarga"=>$kartuKeluargaUrl,
                "surat_keterangan_pindah_sekolah"=>$suratKeteranganPindahSekolahUrl,
                "status"=>'proses'
            ]);
            return redirect('/mutasi');
        } catch (\Throwable $th) {
           dd($th);
        }
    }
    public function show(Mutasi $mutasi)
    {
        $student = $mutasi->load('student');
        return view('pages.mutasi.show', compact('student'));
    }

    public function choice()
    {
        return view('pages.mutasi.choice');
    }

    public function pengajuan()
    {
        $mutasi = Mutasi::with('student')->where('status', 'proses')->get();
        return view('pages.mutasi.pengajuan', compact('mutasi'));
    }

    public function pengajuanShow(Mutasi $mutasi)
    {
        $student = $mutasi->load('student');
        return view('pages.mutasi.pengajuanshow', compact('student'));
    }

    public function pengajuanUpdate(Mutasi $mutasi,Request $request)
    {
        $mutation = Mutasi::where('mutasi_id', $mutasi->mutasi_id);
        $req = $request->only(['status']);
        if($req['status'] == 'tidak'){
            $mutation->update([
                "status"=>'tolak'
            ]);
        }elseif($req['status'] == 'ya'){
            $mutation->update([
                "status"=>'konfirmasi'
            ]);
        }
        return redirect('/mutasi/pengajuan');
    }

    public function riwayat()
    {
        $mutasi = Mutasi::with('student')->where('status','!=' ,'proses')->get();
        return view('pages.mutasi.riwayat', compact('mutasi'));
    }
}
