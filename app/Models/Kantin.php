<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantin extends Model
{
    use HasFactory;

    protected $fillable =  ['kode_kantin', 'nama_kantin', 'employee_id'];
}