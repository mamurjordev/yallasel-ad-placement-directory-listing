<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteFilter extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ads'];

    protected $casts = [
        'ads' => 'array',
    ];
}
