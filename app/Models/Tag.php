<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Service;
use App\Models\Genre;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'tag_name',
        'tag_name_kana',
    ];




    // 支払い方法との多対多
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    // ジャンルとの１対多
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
