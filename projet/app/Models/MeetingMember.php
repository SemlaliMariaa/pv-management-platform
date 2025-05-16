<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingMember extends Model
{
    protected $fillable = ['fullname', 'role'];
}
