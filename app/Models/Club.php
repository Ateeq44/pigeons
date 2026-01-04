<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ur',
        'sort_order',
        'is_featured',
    ];

    // Step 2.2 me Event model banega, tab relationship add karenge
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
