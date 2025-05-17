<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingMember extends Model
{
    protected $table = 'meeting_users'; 
    protected $fillable = ['fullname', 'role', 'signature','user_id',
        'association_name'];


    public function user()
{
    return $this->belongsTo(User::class);
}

public function association()
{
    return $this->belongsTo(User::class, 'association_name', 'name_assotiation');
}
}
