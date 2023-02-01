<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Service;
use App\Models\Tag;


class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_name',
        'genre_name_kana',
    ];



    public function services()
    {
        return $this->hasMany(Service::class);
    }
    // ブログとの１対多
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
