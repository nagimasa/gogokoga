<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Service;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'coupon_title',
        'coupon_text',
        'coupon_image',
        'visualize',
    ];




    public function service()
{
    return $this->belongsTo(Service::class);
}
}
