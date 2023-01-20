<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Service;

class Menu extends Model
{
    use HasFactory;


    protected $fillable = [
        'service_id',
        'menu_name',
        'menu_fee',
    ];

    // 地域との１対多
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
