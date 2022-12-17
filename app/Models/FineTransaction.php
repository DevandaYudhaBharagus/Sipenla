<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FineTransaction extends Model
{
    use HasFactory;

    protected $fillable =  ['user_id', 'fine_transaction_code', 'fine_transaction', 'status'];
}
