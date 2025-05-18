<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingMember extends Model
{
     protected $fillable = [
        'mahdar_id',
        'user_id',
        'fullname',
        'role',
        'signature'
    ];
protected $table = 'meeting_users';
    // Relation avec le PV
    public function mahdar()
    {
        return $this->belongsTo(Mahdar::class);
    }

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
