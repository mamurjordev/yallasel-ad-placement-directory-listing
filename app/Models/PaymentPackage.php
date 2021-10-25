<?php

namespace App\Models;

use App\Models\PackageLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'is_subscription',
        'time_period',
        'subscription_length',
        'post_amount',
        'feature',
        'sort_no',
        'description',
        'status'
    ];

    public function sold()
    {
        return $this->hasMany(PackageLog::class, 'package_id', 'id');
    }
}
