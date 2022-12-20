<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingWithdrawal extends Model
{
    use HasFactory;

    protected $fillable =  ['user_id', 'amount', 'saving_code', 'status' ];
}
