<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'password',
        'telephone',
        'address',
        'name_association',
        'role',
        'roleuser',
        'is_approved'
    ];

    // Relation avec les PVs créés
    public function mahdars()
    {
        return $this->hasMany(Mahdar::class);
    }

    // Relation avec les participations aux réunions
    public function meetingParticipations()
    {
        return $this->hasMany(MeetingMember::class);
    }
}