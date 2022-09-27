<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable =  ['user_id', 'first_name', 'last_name', 'nisn', 'place_of_birth', 'date_of_birth', 'father_name', 'mother_name', 'gender', 'address', 'phone'];
}