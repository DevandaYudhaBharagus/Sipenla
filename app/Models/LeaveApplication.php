<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable =  ['employee_id', 'leave_type_id', 'application_from_date', 'application_to_date', 'application_date', 'purpose', 'abandoned_job'];
}
