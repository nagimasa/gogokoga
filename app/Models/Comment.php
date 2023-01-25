<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Service;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'comment',
    ];



    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
