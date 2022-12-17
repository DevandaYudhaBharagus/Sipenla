<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanBook extends Model
{
    use HasFactory;

    protected $fillable =  ['book_id', 'total_book', 'from_date', 'to_date', 'date', 'status', 'status_loan'];
}
