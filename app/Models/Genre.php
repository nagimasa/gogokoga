<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Service;


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
}
