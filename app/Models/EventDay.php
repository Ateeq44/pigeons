<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'day_date',
        'pigeons_per_loft',
        'sort_order',
    ];

    protected $casts = [
        'day_date' => 'date',
        'pigeons_per_loft' => 'integer',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Next step me Arrival model banega
    public function arrivals()
    {
        return $this->hasMany(Arrival::class, 'event_day_id');
    }

    // ✅ helper: is day ka pigeon count resolve kare
    public function pigeonsCount(): int
    {
        return $this->pigeons_per_loft ?? $this->event->pigeons_per_loft;
    }
}
