<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Service;

class Reqruit extends Model
{
    use HasFactory;
    protected $fillable = [
        'hero_image',
        'reqruit_title',
        'reqruit_text',
        'work_type',
        'work_in_day',
        'work_in_week',
        'fee_type',
        'fee',
        'address',
        'another',
        'service_id',
        'maneger_name',
        'maneger_tel',
        'maneger_email',
        'maneger_name_kana',
        'visualize',
    ];

    // 事業との多対多
public function service()
{
    return $this->belongsTo(Service::class);
}
}
