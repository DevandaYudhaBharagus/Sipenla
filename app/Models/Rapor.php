<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    use HasFactory;

    protected $fillable =  ['student_id', 'subject_id', 'grade_id', 'semester_id', 'academic_year_id', 'nilai_fix', 'status'];
}
