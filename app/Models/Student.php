<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable =  ['user_id', 'date_school_now', 'family_profession', 'first_name', 'last_name', 'school_origin', 'school_now', 'parent_address', 'mother_profession', 'father_profession', 'mother_education', 'father_education', 'family_name', 'family_address', 'nisn', 'place_of_birth', 'date_of_birth', 'father_name', 'mother_name', 'gender', 'address', 'phone', 'religion', 'image', 'extracurricular_id'];
}
