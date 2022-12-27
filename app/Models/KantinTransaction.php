<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KantinTransaction extends Model
{
    use HasFactory;

    protected $fillable =  ['user_id', 'price', 'code_transaction', 'date'];
}
