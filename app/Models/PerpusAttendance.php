<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerpusAttendance extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'employee_id', 'date', 'absensi'];
}
