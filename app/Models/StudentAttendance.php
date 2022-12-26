<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $fillable =  ['student_id', 'grade_id', 'subject_id', 'teacher_id', 'date', 'status'];
}
