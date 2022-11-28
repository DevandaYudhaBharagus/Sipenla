<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    public function saveImage($image, $path='public')
    {
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
    }

    public function index(){
        $facility = Facility::orderBy('created_at', 'desc')->get();
        return view('pages.master.master-fasilitas', compact('facility'));
    }

    public function store(Request $request){
        $data = $request->all();
            $validate = Validator::make($data, [
                'facility_name' => 'required',
                'number_of_facility' => 'required',
                'year' => 'required',
            ],
            [
                'facility_name.required' => 'Nama Fasilitas Harus Diisi.',
                'number_of_facility.required' => 'Jumlah Fasilitas Harus Diisi.',
                'year.required' => 'Tahun Harus Diisi.',
            ]
        );

        $imageEncoded = base64_encode(file_get_contents($request->file('image-facility')->path()));
        $imageFix = $this->saveImage($imageEncoded, "azure");
            $code = mt_rand(1000, 9999);

            $facilityData = Facility::create([
                'facility_code' => $code,
                'facility_name' => $data['facility_name'],
                'number_of_facility' => $data['number_of_facility'],
                'year' => $data['year'],
                'status' => "default",
                'date' => Carbon::now(),
                "image" => $imageFix
            ]);

            return response()->json([
                "error" => false,
                "message" => "Successfuly Added Shift Data!"
            ]);
    }

    public function edit($id)
    {
        $where = array('facility_id' => $id);
        $post  = Facility::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = Facility::where('facility_id', $id);
        $student->update($data);
    }

    public function delete($id){
        try {
            Facility::where('facility_id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted Shift Data!"]);
    }


}
