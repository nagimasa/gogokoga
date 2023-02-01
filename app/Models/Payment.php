<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Service;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_name',
    ];


        // 事業との多対多
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }


}
