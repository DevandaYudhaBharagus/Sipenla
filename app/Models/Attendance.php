<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable =  ['employee_id', 'check_in', 'check_out', 'status', 'date', 'image_check_in', 'image_check_out'];
}
