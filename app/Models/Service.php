<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Area;
use App\Models\Genre;
use App\Models\Payment;
use App\Models\Comment;
use App\Models\Menu;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'area_id',
        'service_name',
        'service_name_kana',
        'email',
        'tel',
        'address',
        'parking',
        'url',
        'googlemap',
        'visualize',
        'another',
        'menu_id',
        'takeout',
        'seat',
        'first_fee',
        'add_fee',
        'stay_fee',
        'cancel_fee',
        'sunday',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'regular_holiday',
        'another',
    ];

    // ジャンルとの１対多
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // 地域との１対多
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    // メニューとの１対多
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    // 支払い方法との多対多
    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
    // コメントとの１対１
    public function comments()
    {
        return $this->hasOne(Comment::class);
    }
}
