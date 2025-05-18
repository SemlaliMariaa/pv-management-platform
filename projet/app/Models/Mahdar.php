<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahdar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id'
    ];

    // Relation avec le créateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les participants
    public function participants()
    {
        return $this->hasMany(MeetingMember::class);
    }

    // Relation avec les besoins
    public function needs()
    {
        return $this->hasMany(Need::class);
    }
}