<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Service;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_name',
        'area_name_kana',
    ];


    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
