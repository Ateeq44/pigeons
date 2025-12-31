<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loft extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ur',
        'city_ur',
        'photo_path',
        'sort_order',
    ];

}
