<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMutation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'to_school'=>'required',
            'letter_school_transfer'=>'required|mimes:pdf',
            'rapor'=>'required|mimes:pdf',
            'letter_ijazah'=>"required|mimes:pdf",
            'letter_no_sanksi'=>'required|mimes:pdf',
            'letter_recom_diknas'=>'required|mimes:pdf',
            'kartu_keluarga'=>'required|mimes:pdf',
            'surat_keterangan_pindah_sekolah'=>'required|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'to_school.required'=>'Pindah ke sekolah tidak boleh kosong',
            'letter_school_transfer.required'=>'Surat Permohonan Pindah Dari Orang Tua / Wali tidak boleh kosong',
            'letter_school_transfer.mimes'=>'Surat Permohonan Pindah Dari Orang Tua / Wali harus berupa PDF',
            'letter_ijazah.mimes'=>'Ijazah harus berupa PDF',
            'letter_ijazah.required'=>'Ijazah tidak boleh kosong',
            'letter_no_sanksi.mimes'=>'Surat Pernyataan Tidak Sedang Menjalani Sanksi harus berupa PDF',
            'letter_no_sanksi.required'=>'Surat Pernyataan Tidak Sedang Menjalani Sanksi tidak boleh kosong',
            'letter_recom_diknas.mimes'=>'Surat Rekomendasi Dari Diknas harus berupa PDF',
            'letter_recom_diknas.required'=>'Surat Rekomendasi Dari Diknas tidak boleh kosong',
            'kartu_keluarga.mimes'=>'KK harus berupa PDF',
            'kartu_keluarga.required'=>'KK tidak boleh kosong',
            'surat_keterangan_pindah_sekolah.mimes'=>'Surat Keterangan Pindah Dari Sekolah Asal harus berupa PDF',
            'surat_keterangan_pindah_sekolah.required'=>'Surat Keterangan Pindah Dari Sekolah Asal tidak boleh kosong',
        ];
    }
}
