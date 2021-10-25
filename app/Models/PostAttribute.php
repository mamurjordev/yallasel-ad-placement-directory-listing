<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAttribute extends Model
{
    use HasFactory;

    protected $fillable =  ['post_id', 'post_attribute'];

    protected $casts = [
        'post_attribute->model year->value' => 'integer',
    ];
}
