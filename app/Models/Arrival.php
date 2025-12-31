<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arrival extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_day_id',
        'loft_id',
        'pigeon_no',
        'arrival_time',
        'duration_seconds',
    ];

    protected $casts = [
        'pigeon_no' => 'integer',
        'duration_seconds' => 'integer',
    ];

    public function day()
    {
        return $this->belongsTo(EventDay::class, 'event_day_id');
    }

    public function loft()
    {
        return $this->belongsTo(Loft::class);
    }
}
