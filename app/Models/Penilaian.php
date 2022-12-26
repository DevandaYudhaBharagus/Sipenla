<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable =  ['student_id', 'grade_id', 'subject_id', 'semester_id', 'academic_year_id', 'assessment_id', 'status', 'nilai'];
}
