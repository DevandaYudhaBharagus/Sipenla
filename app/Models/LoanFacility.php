<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanFacility extends Model
{
    use HasFactory;

    protected $fillable =  ['facility_id', 'total_facility', 'from_date', 'to_date', 'date', 'status', 'person_submitted'];
}
