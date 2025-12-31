<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventLoft extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'loft_id',
        'pigeons_total',
        'prize_amount',
        'sort_order',
    ];

    protected $casts = [
        'pigeons_total' => 'integer',
        'prize_amount'  => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function loft()
    {
        return $this->belongsTo(Loft::class);
    }
}
