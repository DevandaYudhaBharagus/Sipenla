<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;

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

        return view('pages.master.master-pegawai', compact('employees'));
    }

    public function delete($id)
    {
        $employee = Employee::where('user_id', '=', $id);
        $user = User::where('id', '=', $id);
        $employee->delete();
        $user->delete();
        return redirect('/employee');
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
