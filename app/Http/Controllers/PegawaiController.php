<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Workshift;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
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

    public function index()
    {
        $employees = Employee::join('users', 'employees.user_id', '=', 'users.id')
                    ->join('workshifts', 'employees.workshift_id', '=', 'workshifts.workshift_id')
                    ->whereNotIn('role', ['kepsek', 'guru', 'dinaspendidikan'])
                    ->get();

        $workshift = Workshift::get();

        return view('pages.master.master-pegawai', compact('employees', 'workshift'));
    }

    public function edit($id)
    {
        $where = array('employee_id' => $id);
        $post  = Employee::where($where)->first();

        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = request()->except(['_token']);
        $student = Employee::where('employee_id', $id);
        $student->update($data);
    }

    public function delete($id)
    {
        try {
            Employee::where('user_id', $id)->delete();
            User::where('id', $id)->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Sukses Menghapus Data Pegawai"]);
    }

    public function deletePhoto($id)
    {
        $edit = [
            "image" => null
        ];
        $employee = Employee::where('employee_id', '=', $id)->update($edit);
        return redirect('/employee');
    }

    public function updatePhoto(Request $request, $id)
    {

        $imageEncoded = base64_encode(file_get_contents($request->file('profile_employee')->path()));

        $imageFix = $this->saveImage($imageEncoded, "azure");

        $edit = [
            "image" => $imageFix
        ];

        $employee = Employee::where('employee_id', '=', $id)->update($edit);
        return redirect('/employee');
    }
}
