<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Area;
use App\Models\Genre;
use App\Models\Payment;

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

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }


    public function area()
    {
        return $this->belongsTo(Area::class);
    }



    // 支払い方法との多対多
    public function payments()
    {
        return $this->belognsToMany(Payment::class);
    }
}
