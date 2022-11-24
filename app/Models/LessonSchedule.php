<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonSchedule extends Model
{
    use HasFactory;

    protected $fillable =  ['days_id', 'grade_id', 'subject_id', 'teacher_id', 'start_time', 'end_time'];
}
