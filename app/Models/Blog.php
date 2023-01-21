<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Service;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_title',
        'blog_text',
        'blog_image_nmae',
        'service_id',
    ];


        // 地域との１対多
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
