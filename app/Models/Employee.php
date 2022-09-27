<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable =  ['user_id', 'first_name', 'last_name', 'nik', 'place_of_birth', 'date_of_birth', 'gender', 'address', 'phone'];
}
