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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
// 
    public function participants()
    {
        return $this->hasMany(MeetingMember::class);
    }

    public function needs()
    {
        return $this->hasMany(Need::class);
    }
}
// 