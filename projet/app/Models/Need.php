<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory;

   protected $fillable = [
        'mahdar_id',
        'user_id',
        'number',
        'description',
        'quantity_required'
    ];

    // Relation avec le PV
    public function mahdar()
    {
        return $this->belongsTo(Mahdar::class);
    }
};