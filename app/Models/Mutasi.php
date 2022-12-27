<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $fillable =  ['student_id', 'to_school', 'letter_school_transfer', 'letter_ijazah', 'letter_no_sanksi', 'letter_recom_diknas', 'kartu_keluarga', 'surat_keterangan_pindah_sekolah', 'status', 'rapor'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }
}
