<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'worktime',
        'parking',
        'url',
        'googlemap',
        'visualize',
        'another',
        'menu_id',
    ];

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }


    public function area()
    {
        return $this->belongsTo('App\Area');
    }



    // 支払い方法との多対多
    public function payments()
    {
        return $this->belognsToMany('App\Payment');
    }
}
