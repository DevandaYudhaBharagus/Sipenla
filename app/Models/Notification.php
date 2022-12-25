<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable =  ['student_id', 'title', 'notif_type', 'message', 'send_time', 'read_stamp'];
}
