<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Service;

class PhotoTop extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_name',
        'service_id',
    ];

    // 地域との１対多
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
