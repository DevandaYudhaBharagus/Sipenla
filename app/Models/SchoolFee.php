<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFee extends Model
{
    use HasFactory;

    protected $fillable =  ['mount', 'total_price', 'from_date', 'to_date'];
}
