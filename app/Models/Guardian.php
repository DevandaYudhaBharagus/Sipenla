<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $table = 'student_guardians';

    protected $fillable =  ['user_id', 'student_id', 'guardian_name', 'no_kk', 'phone', 'address'];
}
