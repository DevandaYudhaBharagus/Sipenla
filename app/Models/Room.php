<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable =  ['user_id', 'admin_id', 'name_room', 'image_profile', 'status', 'date', 'message'];
}
