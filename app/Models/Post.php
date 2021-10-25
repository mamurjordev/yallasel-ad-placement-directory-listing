<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'detail',
        'name',
        'email',
        'phone',
        'hidePhoneInAd',
        'zipcode',
        'city_id',
        'region_id',
        'payment',
        'reason',
        'is_active',
        'is_seller',
        'is_individual',
        'is_paid',
        'expected_price',
        'is_price_negotiable',
        'status',
    ];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function vipPost()
    {
        return $this->hasOne(VipPost::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
    public function postAttribute()
    {
        return $this->hasOne(PostAttribute::class, 'post_id');
    }
}
