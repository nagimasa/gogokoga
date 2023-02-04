<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Service;

class Addarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'add_area',
        'add_area_image',
    ];

    // 事業との1対1
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
