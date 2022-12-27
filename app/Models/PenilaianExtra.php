<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianExtra extends Model
{
    use HasFactory;

    protected $fillable =  ['student_id', 'semester_id', 'extracurricular_id', 'academic_year_id', 'status', 'nilai'];
}
