<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialDuty extends Model
{
    use HasFactory;

    protected $fillable =  ['employee_id', 'duty_from_date', 'duty_to_date', 'duty_date', 'purpose', 'attachment', 'time', 'place', 'abandoned_job'];

    protected $table = 'official_dutys';
}
