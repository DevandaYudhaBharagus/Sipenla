<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable =  ['book_code', 'book_name', 'book_price', 'book_creator', 'book_year', 'number_of_book', 'status', 'image', 'date', 'student_id', 'employee_id'];
}
