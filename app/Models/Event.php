<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'title_ur',
        'start_time',
        'start_date',
        'end_date',
        'pigeons_per_loft',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'start_date'   => 'date',
        'end_date'     => 'date',
        'is_featured'  => 'boolean',
        'pigeons_per_loft' => 'integer',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    // Next step me EventDay model banega
    public function days()
    {
        return $this->hasMany(EventDay::class);
    }

    // Next step me EventLoft model banega
    public function participants()
    {
        return $this->hasMany(EventLoft::class);
    }
}
