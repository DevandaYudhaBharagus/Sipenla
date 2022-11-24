<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable =  ['facility_code', 'facility_name', 'number_of_facility', 'year', 'owned_by', 'status', 'image', 'date'];
}
